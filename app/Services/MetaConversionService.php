<?php
// app/Services/MetaConversionService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MetaConversionService
{
    protected $pixelId;
    protected $accessToken;
    protected $apiVersion;
    protected $testEventCode;

    public function __construct()
    {
        $this->pixelId = config('meta.pixel_id');
        $this->accessToken = config('meta.access_token');
        $this->apiVersion = config('meta.api_version', 'v21.0');
        $this->testEventCode = config('meta.test_event_code');
    }

    /**
     * Meta CAPI'ye event gönder
     *
     * @param string $eventName - Lead, Purchase, Contact, PageView, vb.
     * @param array $userData - Kullanıcı verileri
     * @param array $customData - Özel veriler (opsiyonel)
     * @return array|false
     */
    public function sendEvent(string $eventName, array $userData, array $customData = [])
    {
        // API endpoint
        $url = "https://graph.facebook.com/{$this->apiVersion}/{$this->pixelId}/events";

        // Event payload oluştur
        $event = [
            'event_name' => $eventName,
            'event_time' => time(),
            'action_source' => 'website',
            'event_source_url' => $userData['source_url'] ?? url()->current(),
            'user_data' => $this->prepareUserData($userData),
        ];

        // Custom data varsa ekle
        if (!empty($customData)) {
            $event['custom_data'] = $customData;
        }

        // Test event code varsa ekle
        if ($this->testEventCode) {
            $event['test_event_code'] = $this->testEventCode;
        }

        // Request payload
        $payload = [
            'data' => [$event],
            'access_token' => $this->accessToken,
        ];

        try {
            // HTTP POST request gönder
            $response = Http::timeout(10)->post($url, $payload);

            if ($response->successful()) {
                Log::info('Meta CAPI Event Sent Successfully', [
                    'event_name' => $eventName,
                    'response' => $response->json()
                ]);
                return $response->json();
            } else {
                Log::error('Meta CAPI Error', [
                    'event_name' => $eventName,
                    'status' => $response->status(),
                    'error' => $response->body()
                ]);
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Meta CAPI Exception', [
                'event_name' => $eventName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    /**
     * User data'yı hazırla (hash'le ve formatla)
     */
    protected function prepareUserData(array $userData): array
    {
        $prepared = [];

        // Email - SHA256 hash
        if (!empty($userData['email'])) {
            $prepared['em'] = [$this->hashData($userData['email'])];
        }

        // Phone - SHA256 hash
        if (!empty($userData['phone'])) {
            $prepared['ph'] = [$this->hashData($this->normalizePhone($userData['phone']))];
        }

        // First Name - SHA256 hash
        if (!empty($userData['first_name'])) {
            $prepared['fn'] = [$this->hashData($userData['first_name'])];
        }

        // Last Name - SHA256 hash
        if (!empty($userData['last_name'])) {
            $prepared['ln'] = [$this->hashData($userData['last_name'])];
        }

        // City - SHA256 hash
        if (!empty($userData['city'])) {
            $prepared['ct'] = [$this->hashData($userData['city'])];
        }

        // Country - SHA256 hash
        if (!empty($userData['country'])) {
            $prepared['country'] = [$this->hashData($userData['country'])];
        }

        // Client IP Address - ŞİFRELENMEMELİ
        if (!empty($userData['client_ip_address'])) {
            $prepared['client_ip_address'] = $userData['client_ip_address'];
        }

        // Client User Agent - ŞİFRELENMEMELİ
        if (!empty($userData['client_user_agent'])) {
            $prepared['client_user_agent'] = $userData['client_user_agent'];
        }

        // FBP Cookie
        if (!empty($userData['fbp'])) {
            $prepared['fbp'] = $userData['fbp'];
        }

        // FBC Cookie (Facebook Click ID)
        if (!empty($userData['fbc'])) {
            $prepared['fbc'] = $userData['fbc'];
        }

        return $prepared;
    }

    /**
     * Veriyi SHA256 ile hash'le
     */
    protected function hashData(?string $data): ?string
    {
        if (empty($data)) {
            return null;
        }
        return hash('sha256', strtolower(trim($data)));
    }

    /**
     * Telefon numarasını normalize et
     */
    protected function normalizePhone(string $phone): string
    {
        // Sadece rakamları al
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Türkiye için: başında 0 varsa kaldır ve 90 ekle
        if (substr($phone, 0, 1) === '0') {
            $phone = '90' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '90') {
            $phone = '90' . $phone;
        }

        return $phone;
    }
}