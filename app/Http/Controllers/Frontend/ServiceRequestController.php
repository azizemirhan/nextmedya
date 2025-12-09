<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequestFormRequest;
use App\Mail\ServiceRequestSubmitted;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class ServiceRequestController extends Controller
{
    public function show()
    {
        // Form sayfasını göster
        return view('frontend.forms.service-request');
    }

    public function store(ServiceRequestFormRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Honeypot kontrolü
        if ($request->filled('website')) {
            Log::warning('Service Request honeypot triggered', [
                'ip' => $request->ip()
            ]);
            return back()->with('error', 'İşlem reddedildi.');
        }

        try {
            // Database'e kaydet
            $serviceRequest = ServiceRequest::create([
                'form_type' => 'service_request',
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company' => $data['company'] ?? null,
                'service_type' => $data['service_type'],
                'package_type' => $data['package_type'] ?? null,
                'package_price' => $data['package_price'] ?? null,
                'selected_features' => $data['selected_features'] ?? [],
                'project_details' => $data['project_details'] ?? null,
                'budget_range' => $data['budget_range'] ?? null,
                'timeline' => $data['timeline'] ?? null,
                'ip' => $request->ip(),
                'user_agent' => substr((string)$request->userAgent(), 0, 255),
                'referrer' => $request->headers->get('referer'),
            ]);

            Log::info('Service request saved', [
                'id' => $serviceRequest->id,
                'service_type' => $data['service_type'],
                'package_type' => $data['package_type'] ?? 'none'
            ]);

        } catch (\Exception $e) {
            Log::error('Service request database save failed: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Talebiniz kaydedilirken bir hata oluştu. Lütfen tekrar deneyin.');
        }

        // Mail gönder
        try {
            $to = config('mail.service_request_to', config('mail.contact_to', 'info@nextmedya.com'));

            Mail::to($to)->send(new ServiceRequestSubmitted([
                ...$data,
                'id' => $serviceRequest->id,
                'ip' => $serviceRequest->ip,
                'ua' => $serviceRequest->user_agent,
            ]));

            Log::info('Service request email sent', [
                'to' => $to,
                'id' => $serviceRequest->id
            ]);

        } catch (\Exception $e) {
            Log::error('Service request mail error: ' . $e->getMessage(), [
                'id' => $serviceRequest->id
            ]);
        }

        // GTM Lead Tracking
        return back()
            ->with('success', __('Talebiniz başarıyla alındı! En kısa sürede size dönüş yapacağız.'))
            ->with('form_submitted', true)
            ->with('lead_data', [
                'name' => $data['name'],
                'email' => $data['email'],
                'service_type' => $data['service_type'],
                'package_type' => $data['package_type'] ?? 'custom',
                'lead_value' => $data['package_price'] ?? 100,
                'lead_source' => 'service_request_form'
            ]);
    }
}