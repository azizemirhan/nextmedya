<?php
namespace App\Http\Controllers;

use http\Env;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private $apiBaseUrl = "http://127.0.0.1:8001/api/v1";
    public function initSession(Request $request)
    {
        try {
            if (!session()->isStarted()) {
                session()->start();
            }

            $sessionId = session()->getId();
            Log::info('Chat init started', ['session_id' => $sessionId]);

            // API'ye artık user_id yerine api_key gönderiyoruz
            // ve doğru endpoint'i çağırıyoruz.
            $response = Http::timeout(10)->post($this->apiBaseUrl . '/visitor/chat/init', [
                'api_key' => '2694d29abf124b4f7aa29cff1971c9be2ead10a8051f8b9fa4554960be611b0d', // master.blade.php'deki anahtarınız
                'session_id' => $sessionId,
                'visitor_ip' => $request->ip(),
                'site_domain' => $request->getHost()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'session_id' => $sessionId,
                    'messages' => $data['messages'] ?? []
                ]);
            } else {
                return $this->localInitSession($request);
            }

        } catch (\Exception $e) {
            Log::error('Chat init error', ['error' => $e->getMessage()]);
            return $this->localInitSession($request);
        }
    }
    public function sendMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'session_id' => 'required|string',
                'message' => 'required|string|max:1000'
            ]);

            $response = Http::timeout(10)->post($this->apiBaseUrl . '/chat/send', [
                'user_id' => $this->defaultUserId,
                'session_id' => $validated['session_id'],
                'message' => $validated['message'],
                'sender_type' => 'visitor',
                'visitor_ip' => $request->ip()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data['data'] ?? $data);
            } else {
                return $this->localSendMessage($request);
            }

        } catch (\Exception $e) {
            Log::error('Send message error', ['error' => $e->getMessage()]);
            return $this->localSendMessage($request);
        }
    }

    public function getMessages(Request $request)
    {
        try {
            $sessionId = $request->input('session_id');

            $response = Http::timeout(10)->get($this->apiBaseUrl . '/chat/messages', [
                'user_id' => $this->defaultUserId,
                'session_id' => $sessionId
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return $this->localGetMessages($request);
            }

        } catch (\Exception $e) {
            Log::error('Get messages error', ['error' => $e->getMessage()]);
            return $this->localGetMessages($request);
        }
    }

    public function updateVisitorInfo(Request $request)
    {
        try {
            $validated = $request->validate([
                'session_id' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]);

            $response = Http::timeout(10)->post($this->apiBaseUrl . '/chat/update-info', [
                'user_id' => $this->defaultUserId,
                'session_id' => $validated['session_id'],
                'name' => $validated['name'],
                'email' => $validated['email']
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return $this->localUpdateVisitorInfo($request);
            }

        } catch (\Exception $e) {
            Log::error('Update visitor info error', ['error' => $e->getMessage()]);
            return $this->localUpdateVisitorInfo($request);
        }
    }

    // Fallback metodları (yerel sistem)
    private function localInitSession(Request $request)
    {
        $sessionId = session()->getId();

        $chatSession = \App\Models\ChatSession::firstOrCreate(
            ['session_id' => $sessionId],
            [
                'visitor_ip' => $request->ip(),
                'status' => 'active',
                'last_activity' => now()
            ]
        );

        $messages = $chatSession->messages()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'success' => true,
            'session_id' => $chatSession->session_id,
            'messages' => $messages
        ]);
    }

    private function localSendMessage(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string',
            'message' => 'required|string|max:1000'
        ]);

        $chatSession = \App\Models\ChatSession::where('session_id', $validated['session_id'])->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $chatSession->update(['last_activity' => now()]);

        $message = \App\Models\ChatMessage::create([
            'chat_session_id' => $chatSession->id,
            'sender_type' => 'visitor',
            'message' => $validated['message']
        ]);

        return response()->json($message);
    }

    private function localGetMessages(Request $request)
    {
        $sessionId = $request->input('session_id');

        $chatSession = \App\Models\ChatSession::where('session_id', $sessionId)->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $messages = $chatSession->messages()->orderBy('created_at', 'asc')->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    private function localUpdateVisitorInfo(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $chatSession = \App\Models\ChatSession::where('session_id', $validated['session_id'])->first();

        if (!$chatSession) {
            return response()->json(['error' => 'Session not found'], 404);
        }

        $chatSession->update([
            'visitor_name' => $validated['name'],
            'visitor_email' => $validated['email']
        ]);

        return response()->json(['success' => true]);
    }
}
