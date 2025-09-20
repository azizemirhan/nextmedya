<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class AccountController extends Controller
{
    use ImageUploadTrait;

    /**
     * GET /accounts
     * q, status, owner_id, trash=1 (yalnızca çöp), with_trashed=1 (hepsi)
     */
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $status = $request->string('status')->toString();
        $ownerId = $request->integer('owner_id');
        $trashOnly = $request->boolean('trash', false);
        $withTrashed = $request->boolean('with_trashed', false);

        $query = Account::query();

        if ($trashOnly) {
            $query->onlyTrashed();
        } elseif ($withTrashed) {
            $query->withTrashed();
        }

        if ($q) {
            // hızlı arama: isim FT + primary email/phone
            $query->where(function ($w) use ($q) {
                $w->whereFullText(['name', 'legal_name'], $q)
                    ->orWhere('primary_email', 'like', "%{$q}%")
                    ->orWhere('primary_phone', 'like', "%{$q}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($ownerId) {
            $query->where('owner_id', $ownerId);
        }

        $accounts = $query->latest()->paginate(20);

        $owners = User::orderBy('name')->get(['id', 'name']);

        return view('admin.accounts.index', compact('accounts', 'owners'));
    }

    /** GET /accounts/create */
    public function create()
    {
        $owners = User::orderBy('name')->get(['id', 'name']);

        return view('admin.accounts.create', compact('owners'));
    }

    /** POST /accounts */
    public function store(Request $request)
    {
        // 1) Validasyon
        $data = $this->validated($request); // ya da $request->validate([...])

        // 2) Normalize (null/boş güvenliği)
        $data['emails'] = $this->normalizeEmails($request->input('emails'));          // [] veya [{value:'',label:''}]
        $data['phones'] = $this->normalizePhones($request->input('phones'));          // [] veya [{number:'',label:''}]
        $data['addresses'] = $this->normalizeAddresses($request->input('addresses'));    // []
        $data['socials'] = $this->normalizeJsonObject($request->input('socials'));     // {} veya null
        $data['custom_fields'] = $this->normalizeJsonObject($request->input('custom_fields')); // {} veya null

        // 3) Tarihler (Model casts varsa düz string kabul eder; istersen elle de parse edebilirsin)
        $data['last_contacted_at'] = $request->filled('last_contacted_at') ? $request->input('last_contacted_at') : null;
        $data['next_activity_at'] = $request->filled('next_activity_at') ? $request->input('next_activity_at') : null;

        // 4) Logo yükleme
        if ($request->hasFile('logo_path')) {
            // uploadImage başarısız olursa exception fırlatmalı, ya da false dönerse yakalayıp mesaj ver.
            $data['logo_path'] = $this->uploadImage($request, 'logo_path', 'uploads/accounts');
        } else {
            // validated içinde 'logo_path' yoksa unset şart değil ama güvenli:
            unset($data['logo_path']);
        }

        // 5) İşlem atomik olsun
        try {
            DB::beginTransaction();

            $account = Account::create($data);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            // İsteğe bağlı: yüklenen dosyayı geri sil
            // if (!empty($data['logo_path'])) Storage::disk('public')->delete($data['logo_path']);

            report($e);

            return back()->withErrors('Kayıt oluşturulamadı: '.$e->getMessage())->withInput();
        }

        return redirect()
            ->route('admin.accounts.preview', $account)
            ->with('success', 'Şirket oluşturuldu.');
    }

    /** GET /accounts/{account}/edit */
    public function edit(Account $account)
    {
        $owners = User::orderBy('name')->get(['id', 'name']);

        return view('admin.accounts.edit', compact('account', 'owners'));
    }

    /** PUT/PATCH /accounts/{account} */
    public function update(Request $request, Account $account)
    {
        $data = $this->validated($request, $account->id);

        // LOGO upload (varsa eskiyi trait zaten siliyor)
        if ($request->hasFile('logo_path')) {
            $data['logo_path'] = $this->uploadImage($request, 'logo_path', 'uploads/accounts', $account->logo_path);
        } else {
            unset($data['logo_path']);
        }

        // JSON normalize
        $data['emails'] = $this->normalizeEmails($request->input('emails', $account->emails));
        $data['phones'] = $this->normalizePhones($request->input('phones', $account->phones));
        $data['addresses'] = $this->normalizeAddresses($request->input('addresses', $account->addresses));
        $data['socials'] = $this->normalizeJsonObject($request->input('socials', $account->socials));
        $data['custom_fields'] = $this->normalizeJsonObject($request->input('custom_fields', $account->custom_fields));

        $account->update($data);

        return redirect()->route('admin.accounts.preview', $account)->with('success', 'Şirket güncellendi.');
    }

    /** DELETE (soft) /accounts/{account} */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('admin.accounts.index')->with('success', 'Şirket çöp kutusuna taşındı.');
    }

    /** POST /accounts/{id}/restore */
    public function restore($id)
    {
        $account = Account::onlyTrashed()->findOrFail($id);
        $account->restore();

        return redirect()->route('admin.accounts.show', $account)->with('success', 'Şirket geri yüklendi.');
    }

    /** DELETE (hard) /accounts/{id}/force-delete */
    public function forceDelete($id)
    {
        $account = Account::onlyTrashed()->findOrFail($id);

        // Logo varsa fiziksel dosyayı silelim (trait'teki deleteImage ile)
        if (! empty($account->logo_path)) {
            $this->deleteImage($account->logo_path);
        }

        $account->forceDelete();

        return redirect()->route('accounts.index')->with('success', 'Şirket kalıcı olarak silindi.');
    }

    /**
     * Quill/Editor AJAX resim yükleme endpoint’i
     * POST /accounts/upload (FormData: file)
     */
    public function upload(Request $request)
    {
        $path = $this->uploadImage($request, 'file', 'uploads/accounts');
        if ($path) {
            // Quill 'location' bekliyor
            return response()->json(['location' => asset($path)]);
        }

        return response()->json(['error' => 'Dosya yüklenemedi'], 422);
    }

    // ---------- Helpers ----------

    private function validated(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'legal_name' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:64'],
            'registration_no' => ['nullable', 'string', 'max:64'],

            'industry' => ['nullable', 'string', 'max:120'],
            'employee_count' => ['nullable', 'integer', 'min:0'],
            'annual_revenue' => ['nullable', 'integer', 'min:0'],
            'lifecycle_stage' => ['required', Rule::in(['lead', 'customer', 'partner', 'vendor', 'other'])],
            'status' => ['required', Rule::in(['active', 'inactive', 'prospect', 'churned'])],
            'score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'source' => ['nullable', 'string', 'max:120'],

            'owner_id' => ['nullable', 'exists:users,id'],

            // Tarihler
            'last_contacted_at' => ['nullable', 'date'],
            'next_activity_at' => ['nullable', 'date'],

            // Dosya
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,webp,gif', 'max:4096'],

            // JSON alanlar — string (JSON), array veya virgüllü metin gelebilir; normalize edeceğiz
            'emails' => ['nullable'],
            'phones' => ['nullable'],
            'addresses' => ['nullable'],
            'socials' => ['nullable'],
            'custom_fields' => ['nullable'],
        ]);
    }

    /** emails: JSON string | array | "a@x.com,b@y.com" -> uniform dizi [{value, label?, primary?}] */
    private function normalizeEmails($input): array
    {
        if (is_string($input) && $input !== '') {
            // JSON ise decode; değilse virgüllü liste
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $this->coerceEmails($decoded);
            }
            $parts = array_filter(array_map('trim', explode(',', $input)));

            return array_values(array_map(fn ($v) => ['value' => $v, 'label' => 'work'], $parts));
        }
        if (is_array($input)) {
            return $this->coerceEmails($input);
        }

        return [];
    }

    private function coerceEmails(array $arr): array
    {
        $out = [];
        foreach ($arr as $i => $item) {
            if (is_string($item)) {
                $out[] = ['value' => $item, 'label' => 'work', 'primary' => $i === 0];
            } elseif (is_array($item) && ! empty($item['value'])) {
                $out[] = [
                    'value' => $item['value'],
                    'label' => $item['label'] ?? 'work',
                    'primary' => (bool) ($item['primary'] ?? $i === 0),
                ];
            }
        }

        return $out;
    }

    /** phones: JSON string | array | "532...,0212..." -> [{number, label, country?}] */
    private function normalizePhones($input): array
    {
        if (is_string($input) && $input !== '') {
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $this->coercePhones($decoded);
            }
            $parts = array_filter(array_map('trim', explode(',', $input)));

            return array_values(array_map(fn ($v) => ['number' => $v, 'label' => 'work'], $parts));
        }
        if (is_array($input)) {
            return $this->coercePhones($input);
        }

        return [];
    }

    private function coercePhones(array $arr): array
    {
        $out = [];
        foreach ($arr as $i => $item) {
            if (is_string($item)) {
                $out[] = ['number' => $item, 'label' => 'work', 'primary' => $i === 0];
            } elseif (is_array($item) && ! empty($item['number'])) {
                $out[] = [
                    'number' => $item['number'],
                    'label' => $item['label'] ?? 'work',
                    'country' => $item['country'] ?? null,
                    'primary' => (bool) ($item['primary'] ?? $i === 0),
                ];
            }
        }

        return $out;
    }

    /** addresses: JSON string|array -> array */
    private function normalizeAddresses($input): array
    {
        if (is_string($input) && $input !== '') {
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }
        if (is_array($input)) {
            return $input;
        }

        return [];
    }

    /** socials/custom_fields: JSON string|array -> object(array) */
    private function normalizeJsonObject($input): array
    {
        if (is_string($input) && $input !== '') {
            $decoded = json_decode($input, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }
        if (is_array($input)) {
            return $input;
        }

        return [];
    }

    // app/Http/Controllers/AccountController.php

    public function preview($id)
    {
        // Soft delete edilmiş kayıtları da göstermek için withTrashed kullanabilirsin
        $account = Account::withTrashed()->with('owner')->findOrFail($id);

        // View dosyası: resources/views/accounts/preview.blade.php
        return view('admin.accounts.preview', compact('account'));
    }
}
