<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequestFormRequest;
use App\Mail\MeetingRequestSubmitted;
use App\Models\MeetingRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class MeetingRequestController extends Controller
{
    public function show()
    {
        // Form sayfasını göster
        return view('frontend.forms.meeting-request');
    }

    public function store(MeetingRequestFormRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Honeypot kontrolü
        if ($request->filled('website')) {
            Log::warning('Meeting Request honeypot triggered', [
                'ip' => $request->ip()
            ]);
            return back()->with('error', 'İşlem reddedildi.');
        }

        try {
            // Database'e kaydet
            $meetingRequest = MeetingRequest::create([
                'form_type' => 'meeting_request',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company' => $data['company'] ?? null,
                'preferred_date' => $data['preferred_date'],
                'preferred_time' => $data['preferred_time'],
                'preferred_time_slot' => $data['preferred_time_slot'] ?? null,
                'alternative_date' => $data['alternative_date'] ?? null,
                'alternative_time' => $data['alternative_time'] ?? null,
                'contact_methods' => $data['contact_methods'],
                'meeting_type' => $data['meeting_type'],
                'meeting_platform' => $data['meeting_platform'] ?? null,
                'topic' => $data['topic'],
                'message' => $data['message'] ?? null,
                'ip' => $request->ip(),
                'user_agent' => substr((string)$request->userAgent(), 0, 255),
                'referrer' => $request->headers->get('referer'),
                'status' => 'pending',
            ]);

            Log::info('Meeting request saved', [
                'id' => $meetingRequest->id,
                'preferred_date' => $data['preferred_date'],
                'topic' => $data['topic']
            ]);

        } catch (\Exception $e) {
            Log::error('Meeting request database save failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Talebiniz kaydedilirken bir hata oluştu. Lütfen tekrar deneyin.');
        }

        // Mail gönder
        try {
            $to = config('mail.meeting_request_to', config('mail.contact_to', 'info@nextmedya.com'));

            Mail::to($to)->send(new MeetingRequestSubmitted([
                ...$data,
                'id' => $meetingRequest->id,
                'ip' => $meetingRequest->ip,
                'ua' => $meetingRequest->user_agent,
            ]));

            Log::info('Meeting request email sent', [
                'to' => $to,
                'id' => $meetingRequest->id
            ]);

        } catch (\Exception $e) {
            Log::error('Meeting request mail error: ' . $e->getMessage(), [
                'id' => $meetingRequest->id
            ]);
        }

        // GTM Lead Tracking
        return back()
            ->with('success', __('Toplantı talebiniz alındı! Size en kısa sürede dönüş yapacağız.'))
            ->with('form_submitted', true)
            ->with('lead_data', [
                'name' => $data['name'],
                'email' => $data['email'],
                'meeting_date' => $data['preferred_date'],
                'meeting_topic' => $data['topic'],
                'lead_value' => 150, // Meeting request değeri
                'lead_source' => 'meeting_request_form'
            ]);
    }
}