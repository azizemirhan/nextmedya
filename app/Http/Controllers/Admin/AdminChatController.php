<?php
// app/Http/Controllers/Admin/AdminChatController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminChatController extends Controller
{
    public function index()
    {
        $sessions = ChatSession::with(['messages' => function ($query) {
            $query->latest()->limit(1);
        }])
            ->withCount('unreadVisitorMessages')
            ->orderBy('last_activity', 'desc')
            ->get();

        return view('admin.chat.index', compact('sessions'));
    }

    public function getSession($id)
    {
        try {
            $session = ChatSession::with(['messages' => function ($query) {
                $query->with('admin')->orderBy('created_at', 'asc');
            }])->findOrFail($id);

            // Visitor mesajlarını okundu olarak işaretle
            $session->unreadVisitorMessages()->update(['is_read' => true]);

            return response()->json($session);
        } catch (\Exception $e) {
            Log::error('Get session error', [
                'session_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Session yüklenemedi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sendMessage(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $session = ChatSession::findOrFail($id);
            $session->update(['last_activity' => now()]);

            $message = ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender_type' => 'admin',
                'admin_id' => auth()->id(),
                'message' => $request->message
            ]);

            return response()->json($message->load('admin'));
        } catch (\Exception $e) {
            Log::error('Send message error', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function closeSession($id)
    {
        try {
            $session = ChatSession::findOrFail($id);
            $session->update(['status' => 'closed']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Close session error', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
