<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RecaptchaLog extends Model
{
    protected $fillable = [
        'ip_address',
        'score',
        'action',
        'success',
        'hostname',
        'form_type',
        'user_agent',
        'route_name',
        'error_codes',
        'challenge_ts',
    ];

    protected $casts = [
        'score' => 'decimal:2',
        'success' => 'boolean',
        'error_codes' => 'array',
        'challenge_ts' => 'datetime',
    ];

    /**
     * Scope: Sadece başarılı doğrulamalar
     */
    public function scopeSuccessful(Builder $query): Builder
    {
        return $query->where('success', true);
    }

    /**
     * Scope: Sadece başarısız doğrulamalar
     */
    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('success', false);
    }

    /**
     * Scope: Bot şüphesi (düşük skor)
     */
    public function scopeLowScore(Builder $query, float $threshold = 0.5): Builder
    {
        return $query->where('score', '<', $threshold);
    }

    /**
     * Scope: Yüksek skor (güvenilir)
     */
    public function scopeHighScore(Builder $query, float $threshold = 0.7): Builder
    {
        return $query->where('score', '>=', $threshold);
    }

    /**
     * Scope: Bugünün kayıtları
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope: Bu haftanın kayıtları
     */
    public function scopeThisWeek(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    /**
     * Scope: Bu ayın kayıtları
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Scope: Belirli bir IP adresi
     */
    public function scopeByIp(Builder $query, string $ip): Builder
    {
        return $query->where('ip_address', $ip);
    }

    /**
     * Scope: Belirli bir form tipi
     */
    public function scopeByFormType(Builder $query, string $formType): Builder
    {
        return $query->where('form_type', $formType);
    }

    /**
     * İstatistikler için helper method
     */
    public static function getStats(string $period = 'today'): array
    {
        $query = match($period) {
            'today' => self::today(),
            'week' => self::thisWeek(),
            'month' => self::thisMonth(),
            default => self::query(),
        };

        $total = $query->count();
        $successful = $query->successful()->count();
        $failed = $query->failed()->count();
        $avgScore = $query->avg('score') ?? 0;
        $lowScoreCount = $query->lowScore()->count();

        return [
            'total' => $total,
            'successful' => $successful,
            'failed' => $failed,
            'success_rate' => $total > 0 ? round(($successful / $total) * 100, 2) : 0,
            'avg_score' => round($avgScore, 2),
            'low_score_count' => $lowScoreCount,
            'bot_rate' => $total > 0 ? round(($lowScoreCount / $total) * 100, 2) : 0,
        ];
    }

    /**
     * IP bazlı istatistikler
     */
    public static function getTopIps(int $limit = 10, string $period = 'week'): array
    {
        $query = match($period) {
            'today' => self::today(),
            'week' => self::thisWeek(),
            'month' => self::thisMonth(),
            default => self::query(),
        };

        return $query
            ->select('ip_address')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->selectRaw('MIN(score) as min_score')
            ->groupBy('ip_address')
            ->orderByDesc('total')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    /**
     * Saatlik dağılım
     */
    public static function getHourlyDistribution(string $date = null): array
    {
        $date = $date ?? today()->toDateString();

        return self::whereDate('created_at', $date)
            ->selectRaw('HOUR(created_at) as hour')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->mapWithKeys(fn($item) => [
                $item->hour => [
                    'total' => $item->total,
                    'avg_score' => round($item->avg_score, 2),
                ]
            ])
            ->toArray();
    }

    /**
     * Form tipi bazlı istatistikler
     */
    public static function getFormTypeStats(): array
    {
        return self::select('form_type')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('AVG(score) as avg_score')
            ->selectRaw('SUM(CASE WHEN success = 1 THEN 1 ELSE 0 END) as successful')
            ->groupBy('form_type')
            ->get()
            ->mapWithKeys(fn($item) => [
                    $item->form_type ?? 'unknown' => [
                    'total' => $item->total,
                    'avg_score' => round($item->avg_score, 2),
                    'successful' => $item->successful,
                    'success_rate' => round(($item->successful / $item->total) * 100, 2),
                ]
            ])
            ->toArray();
    }
}