<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterSubscriberController extends Controller
{
    /**
     * Listeleme + filtreleme
     */
    public function index(Request $request)
    {
        // Debugging: İstekle gelen tüm parametreleri kontrol edin
        // dd($request->all());

        $subscribers = NewsletterSubscriber::query();

        // Arama (email) filtresi
        if ($request->filled('q')) {
            $subscribers->where('email', 'like', '%' . $request->q . '%');
        }

        // Durum filtresi
        if ($request->filled('status') && $request->status !== 'all') {
            $subscribers->where('status', $request->status); // status alanının tipine göre true/false veya 1/0 olabilir
        }

        // Başlangıç tarihi filtresi
        if ($request->filled('start_date')) {
            $subscribers->whereDate('created_at', '>=', $request->start_date);
        }

        // Bitiş tarihi filtresi
        if ($request->filled('end_date')) {
            $subscribers->whereDate('created_at', '<=', $request->end_date);
        }

        // Sayfalama ile verileri çekin
        $subscribers = $subscribers->orderBy('created_at', 'desc')->paginate(10); // İsteğe bağlı sayfa boyutu

        // Debugging: Verilerin çekilip çekilmediğini kontrol edin
        // dd($subscribers);

        return view('admin.subscribers.index', compact('subscribers'));
        // View yolu sizin projenize göre farklı olabilir. Örn: 'admin.newsletter.subscribers.index'
    }

    /**
     * CSV export
     */
    public function export(Request $request): StreamedResponse
    {
        $file = 'subscribers_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$file}\"",
        ];

        $q = $request->string('q');
        $status = $request->string('status');

        $query = NewsletterSubscriber::query()
            ->when($q, fn($subQ) => $subQ->where('email', 'like', "%{$q}%"))
            ->when($status, fn($subQ) => $subQ->where('status', $status))
            ->orderBy('id');

        $columns = ['id', 'email', 'status', 'created_at', 'updated_at', 'ip', 'user_agent'];

        return response()->stream(function () use ($query, $columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            $query->chunk(500, function ($rows) use ($out, $columns) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->id,
                        $r->email,
                        $r->status,
                        $r->created_at,
                        $r->updated_at,
                        $r->ip,
                        $r->user_agent
                    ]);
                }
            });

            fclose($out);
        }, 200, $headers);
    }

    /**
     * Abonelikten çıkar
     */
    public function unsubscribe($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->update(['status' => 'unsubscribed']);
        return back()->with('success', 'Abone abonelikten çıkarıldı.');
    }

    /**
     * Tekrar aktifleştir
     */
    public function resubscribe($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->update(['status' => 'confirmed']);
        return back()->with('success', 'Abone yeniden aktif edildi.');
    }

    /**
     * Kalıcı sil
     */
    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return back()->with('success', 'Abone silindi.');
    }
}
