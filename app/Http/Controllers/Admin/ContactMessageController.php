<?php

// app/Http/Controllers/Admin/ContactMessageController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactMessageController extends Controller
{
    public function index(Request $r)
    {
        $search = $r->string('q');
        $onlyUnread = (bool)$r->boolean('unread');
        $dateFrom = $r->date('from');
        $dateTo = $r->date('to');

        $q = ContactMessage::query()
            ->when($onlyUnread, fn($q) => $q->unread())
            ->search($search)
            ->when($dateFrom, fn($q) => $q->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->whereDate('created_at', '<=', $dateTo))
            ->latest();

        $messages = $q->paginate(15)->withQueryString();

        // widget verileri
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'last7' => ContactMessage::where('created_at', '>=', now()->subDays(7))->count(),
            'last30' => ContactMessage::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return view('admin.contactform.index', compact('messages', 'stats', 'search', 'onlyUnread', 'dateFrom', 'dateTo'));
    }

    public function show($id)
    {
        $m = ContactMessage::findOrFail($id);
        if (is_null($m->read_at)) {
            $m->markAsRead();
        }
        return view('admin.contactform.show', compact('m'));
    }

    public function read($id)
    {
        $m = ContactMessage::findOrFail($id);
        $m->markAsRead();
        return back()->with('success', 'Mesaj okundu olarak işaretlendi.');
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.contactforms.index')->with('success', 'Mesaj silindi.');
    }

    // Basit CSV export
    public function export(): StreamedResponse
    {
        $file = 'contact_messages_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$file\"",
        ];
        $columns = ['id', 'created_at', 'name', 'email', 'subject', 'message', 'ip', 'user_agent', 'read_at'];

        return response()->stream(function () use ($columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);
            ContactMessage::orderBy('id')->chunk(500, function ($rows) use ($out, $columns) {
                foreach ($rows as $r) {
                    fputcsv($out, [
                        $r->id, $r->created_at, $r->name, $r->email, $r->subject,
                        $r->message, $r->ip, $r->user_agent, $r->read_at
                    ]);
                }
            });
            fclose($out);
        }, 200, $headers);
    }
}

