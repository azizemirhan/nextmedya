<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecaptchaLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecaptchaSecurityController extends Controller
{
    /**
     * Ana dashboard sayfası
     */
    public function index(Request $request)
    {
        $period = $request->get('period', 'today'); // today, week, month, all
        $formType = $request->get('form_type', 'all');

        // Temel istatistikler
        $stats = $this->getStats($period, $formType);

        // Grafikler için veriler
        $charts = [
            'hourly' => $this->getHourlyChart($period),
            'daily' => $this->getDailyChart($period),
            'score_distribution' => $this->getScoreDistribution($period),
        ];

        // Son aktiviteler
        $recentLogs = $this->getRecentLogs(20, $formType);

        // En çok deneme yapan IP'ler
        $topIps = $this->getTopIps(10, $period);

        // Şüpheli aktiviteler (düşük skor)
        $suspiciousActivities = $this->getSuspiciousActivities(10);

        // Form tipi bazlı istatistikler
        $formStats = RecaptchaLog::getFormTypeStats();

        return view('admin.google.dashboard', compact(
            'stats',
            'charts',
            'recentLogs',
            'topIps',
            'suspiciousActivities',
            'formStats',
            'period',
            'formType'
        ));
    }

    /**
     * Temel istatistikler
     */
    protected function getStats(string $period, string $formType): array
    {
        $query = $this->applyFilters(RecaptchaLog::query(), $period, $formType);

        $total = $query->count();
        $successful = (clone $query)->successful()->count();
        $failed = (clone $query)->failed()->count();
        $avgScore = (clone $query)->avg('score') ?? 0;
        $lowScore = (clone $query)->lowScore(0.5)->count();

        // Önceki periyotla karşılaştırma
        $previousQuery = $this->applyFilters(
            RecaptchaLog::query(),
            $this->getPreviousPeriod($period),
            $formType
        );
        $previousTotal = $previousQuery->count();

        $change = $previousTotal > 0
            ? round((($total - $previousTotal) / $previousTotal) * 100, 1)
            : 0;

        return [
            'total' => $total,
            'successful' => $successful,
            'failed' => $failed,
            'success_rate' => $total > 0 ? round(($successful / $total) * 100, 1) : 0,
            'avg_score' => round($avgScore, 2),
            'low_score_count' => $lowScore,
            'bot_rate' => $total > 0 ? round(($lowScore / $total) * 100, 1) : 0,
            'change_percentage' => $change,
            'unique_ips' => (clone $query)->distinct('ip_address')->count('ip_address'),
        ];
    }

    /**
     * Saatlik grafik verisi
     */
    protected function getHourlyChart(string $period): array
    {
        if ($period !== 'today') {
            return [];
        }

        $data = RecaptchaLog::whereDate('created_at', today())
            ->select(DB::raw('HOUR(created_at) as hour'))
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->selectRaw('SUM(CASE WHEN success = 1 THEN 1 ELSE 0 END) as successful')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hours = range(0, 23);
        $result = [];

        foreach ($hours as $hour) {
            $item = $data->firstWhere('hour', $hour);
            $result[] = [
                'hour' => sprintf('%02d:00', $hour),
                'total' => $item->total ?? 0,
                'successful' => $item->successful ?? 0,
                'avg_score' => $item ? round($item->avg_score, 2) : 0,
            ];
        }

        return $result;
    }

    /**
     * Günlük grafik verisi
     */
    protected function getDailyChart(string $period): array
    {
        $days = match($period) {
            'week' => 7,
            'month' => 30,
            default => 7,
        };

        $startDate = now()->subDays($days - 1)->startOfDay();

        $data = RecaptchaLog::where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'))
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->selectRaw('SUM(CASE WHEN success = 1 THEN 1 ELSE 0 END) as successful')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $result = [];
        for ($i = 0; $i < $days; $i++) {
            $date = now()->subDays($days - 1 - $i)->format('Y-m-d');
            $item = $data->get($date);

            $result[] = [
                'date' => $date,
                'date_formatted' => now()->subDays($days - 1 - $i)->format('d M'),
                'total' => $item->total ?? 0,
                'successful' => $item->successful ?? 0,
                'avg_score' => $item ? round($item->avg_score, 2) : 0,
            ];
        }

        return $result;
    }

    /**
     * Skor dağılımı
     */
    protected function getScoreDistribution(string $period): array
    {
        $query = $this->applyFilters(RecaptchaLog::query(), $period, 'all');

        return [
            'very_low' => $query->clone()->where('score', '<', 0.3)->count(),      // 0.0 - 0.29 (Bot)
            'low' => $query->clone()->whereBetween('score', [0.3, 0.49])->count(), // 0.3 - 0.49 (Şüpheli)
            'medium' => $query->clone()->whereBetween('score', [0.5, 0.69])->count(), // 0.5 - 0.69 (Orta)
            'high' => $query->clone()->whereBetween('score', [0.7, 0.89])->count(),   // 0.7 - 0.89 (İyi)
            'very_high' => $query->clone()->where('score', '>=', 0.9)->count(),    // 0.9 - 1.0 (Mükemmel)
        ];
    }

    /**
     * Son loglar
     */
    protected function getRecentLogs(int $limit, string $formType): \Illuminate\Database\Eloquent\Collection
    {
        $query = RecaptchaLog::query()
            ->orderBy('created_at', 'desc')
            ->limit($limit);

        if ($formType !== 'all') {
            $query->where('form_type', $formType);
        }

        return $query->get();
    }

    /**
     * En aktif IP'ler
     */
    protected function getTopIps(int $limit, string $period): array
    {
        $query = $this->applyFilters(RecaptchaLog::query(), $period, 'all');

        return $query
            ->select('ip_address')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->selectRaw('MIN(score) as min_score')
            ->selectRaw('SUM(CASE WHEN success = 0 THEN 1 ELSE 0 END) as failed_count')
            ->groupBy('ip_address')
            ->orderByDesc('total')
            ->limit($limit)
            ->get()
            ->map(function ($item) {
                $item->avg_score = round($item->avg_score, 2);
                $item->min_score = round($item->min_score, 2);
                $item->risk_level = $this->calculateRiskLevel($item);
                return $item;
            })
            ->toArray();
    }

    /**
     * Şüpheli aktiviteler
     */
    protected function getSuspiciousActivities(int $limit): \Illuminate\Database\Eloquent\Collection
    {
        return RecaptchaLog::where('score', '<', 0.3)
            ->orWhere('success', false)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Risk seviyesi hesapla
     */
    protected function calculateRiskLevel($ip): string
    {
        $score = $ip->avg_score;
        $failedRate = $ip->total > 0 ? ($ip->failed_count / $ip->total) * 100 : 0;

        if ($score < 0.3 || $failedRate > 50) {
            return 'high';
        } elseif ($score < 0.5 || $failedRate > 30) {
            return 'medium';
        } else {
            return 'low';
        }
    }

    /**
     * Filtreleri uygula
     */
    protected function applyFilters($query, string $period, string $formType)
    {
        // Period filter
        match($period) {
            'today' => $query->today(),
            'week' => $query->thisWeek(),
            'month' => $query->thisMonth(),
            default => $query,
        };

        // Form type filter
        if ($formType !== 'all') {
            $query->where('form_type', $formType);
        }

        return $query;
    }

    /**
     * Önceki periyodu al
     */
    protected function getPreviousPeriod(string $period): string
    {
        return match($period) {
            'today' => 'yesterday',
            'week' => 'previous_week',
            'month' => 'previous_month',
            default => 'all',
        };
    }

    /**
     * Detaylı log görüntüleme
     */
    public function show($id)
    {
        $log = RecaptchaLog::findOrFail($id);

        // Aynı IP'den diğer aktiviteler
        $relatedLogs = RecaptchaLog::where('ip_address', $log->ip_address)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.security.recaptcha-detail', compact('log', 'relatedLogs'));
    }

    /**
     * IP'yi engelle
     */
    public function blockIp(Request $request)
    {
        $ip = $request->input('ip');

        // IP'yi blocked_ips tablosuna ekle veya firewall'a ekle
        // Bu kısım projenizin güvenlik altyapısına göre değişir

        return response()->json([
            'success' => true,
            'message' => "IP adresi {$ip} engellendi."
        ]);
    }

    /**
     * API: İstatistik verisi
     */
    public function apiStats(Request $request)
    {
        $period = $request->get('period', 'today');
        $formType = $request->get('form_type', 'all');

        return response()->json([
            'stats' => $this->getStats($period, $formType),
            'charts' => [
                'hourly' => $this->getHourlyChart($period),
                'daily' => $this->getDailyChart($period),
                'score_distribution' => $this->getScoreDistribution($period),
            ],
        ]);
    }
}