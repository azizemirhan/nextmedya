<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Contact;
use App\Traits\ImageUploadTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ImageUploadTrait;

    // Trait'i kullans

    // app/Http/Controllers/Admin/ContactController.php

    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $query = Contact::query()
            ->when($q, function ($qq) use ($q) {
                $qq->where(function ($s) use ($q) {
                    $s->where('first_name', 'like', "%{$q}%")
                        ->orWhere('last_name', 'like', "%{$q}%")
                        ->orWhere('primary_email', 'like', "%{$q}%")
                        ->orWhere('primary_phone', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id');

        $contacts = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            // Sadece liste parçasını gönder
            return view('admin.contacts._contact_list', compact('contacts'))->render();
        }

        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        // Şirket seçimi dropdown'ı için tüm şirketleri alıyoruz.
        $accounts = Account::orderBy('name')->get();

        return view('admin.contacts.create', compact('accounts'));
    }

    // app/Http/Controllers/Admin/ContactController.php

    public function store(Request $request)
    {
        // 1. Gelen tüm veriyi doğrula
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'account_id' => 'nullable|exists:accounts,id',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // name="profile_photo" olmalı
            'emails' => 'nullable|array',
            'emails.*.value' => 'nullable|email',
            'emails.*.label' => 'nullable|string',
            'phones' => 'nullable|array',
            'phones.*.number' => 'nullable|string',
            'phones.*.label' => 'nullable|string',
            'source' => 'nullable|string|max:255',
            'score' => 'nullable|integer|min:0|max:100',
            'addresses' => 'nullable|array',
            'addresses.*.line1' => 'nullable|string',
            'addresses.*.city' => 'nullable|string',
            // ... diğer adres alanları için de benzer kurallar ...
            'socials' => 'nullable|array',
            'socials.*' => 'nullable|url',
            'notes' => 'nullable|string',
            'credentials' => 'nullable|array',
            'credentials.*.login_url' => 'nullable|url',
            'credentials.*.username' => 'nullable|string',
            'credentials.*.password' => 'nullable|string',
        ]);

        // 2. Resim yükleme işlemini Trait ile yap
        $validatedData['profile_photo_path'] = $this->uploadImage($request, 'profile_photo', 'tum-yuklemeler/contacts');

        // 3. Boolean (checkbox/switch) alanlarını işle
        $validatedData['is_decision_maker'] = $request->has('is_decision_maker');
        $validatedData['consent_email'] = $request->has('consent_email');
        $validatedData['consent_sms'] = $request->has('consent_sms');

        // 4. Boş gönderilen dinamik alan satırlarını temizle
        if (isset($validatedData['emails'])) {
            $validatedData['emails'] = array_values(array_filter($validatedData['emails'], fn($email) => !empty($email['value'])));
        }
        if (isset($validatedData['phones'])) {
            $validatedData['phones'] = array_values(array_filter($validatedData['phones'], fn($phone) => !empty($phone['number'])));
        }
        if (isset($validatedData['socials'])) {
            $validatedData['socials'] = array_filter($validatedData['socials']);
        }
        if (isset($validatedData['addresses'])) {
            $filteredAddresses = collect($validatedData['addresses'])->filter(fn($address) => count(array_filter($address)) > 0);
            $validatedData['addresses'] = $filteredAddresses->values()->all();
        }
        if (isset($validatedData['credentials'])) {
            $filteredCredentials = collect($validatedData['credentials'])->filter(fn($cred) => !empty($cred['login_url']) || !empty($cred['username']));
            $validatedData['credentials'] = $filteredCredentials->values()->all();
        }

        // 5. Kişiyi oluştur
        Contact::create($validatedData);

        return redirect()->route('admin.contacts.index')->with('success', 'Kişi başarıyla oluşturuldu.');
    }

    public function edit(Contact $contact)
    {
        $accounts = Account::orderBy('name')->get();
        return view('admin.contacts.edit', compact('contact', 'accounts'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'account_id' => 'nullable|exists:accounts,id',
            'job_title' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:12048',
            'emails' => 'nullable|array',
            'emails.*.value' => 'nullable|email',
            'emails.*.label' => 'nullable|string',
            'phones' => 'nullable|array',
            'phones.*.number' => 'nullable|string',
            'phones.*.label' => 'nullable|string',
            'source' => 'nullable|string|max:255',
            'score' => 'nullable|integer|min:0|max:100',
            'addresses' => 'nullable|array', // Yeni
            'socials' => 'nullable|array',
            'socials.linkedin' => 'nullable|url', // GÜNCELLEME
            'socials.x' => 'nullable|url',         // GÜNCELLEME
            'socials.instagram' => 'nullable|url', // GÜNCELLEME
            'socials.facebook' => 'nullable|url',  // GÜNCELLEME
            'notes' => 'nullable|string',
            'credentials' => 'nullable|array',
            'credentials.*.login_url' => 'nullable|url',
            'credentials.*.username' => 'nullable|string',
            'credentials.*.password' => 'nullable|string',
            'credentials.*.customer_no' => 'nullable|string',
            'credentials.*.two_fa_status' => 'nullable|in:var,yok',
        ]);


        $validatedData['profile_photo_path'] = $this->uploadImage($request, 'profile_photo_path', 'tum-yuklemeler/contacts', $contact->profile_photo_path);
        $validatedData['is_decision_maker'] = $request->has('is_decision_maker');
        $validatedData['consent_email'] = $request->has('consent_email');
        $validatedData['consent_sms'] = $request->has('consent_sms');


        if (isset($validatedData['emails'])) {
            $validatedData['emails'] = array_filter($validatedData['emails'], fn($email) => !empty($email['value']));
        }

        if (isset($validatedData['phones'])) {
            $validatedData['phones'] = array_filter($validatedData['phones'], fn($phone) => !empty($phone['number']));
        }
        if (isset($validatedData['socials'])) {
            $validatedData['socials'] = array_filter($validatedData['socials']);
        }
        if (isset($validatedData['addresses'])) {
            $filteredAddresses = collect($validatedData['addresses'])->filter(function ($address) {
                // Bir adres bloğunun içindeki tüm değerleri filtrele.
                // Eğer sonuçta hala bir eleman kalıyorsa (yani en az bir alan doluysa),
                // o adres bloğunu koru.
                return count(array_filter($address)) > 0;
            });

            // Filtrelenmiş koleksiyonu tekrar düz bir diziye çevir.
            $validatedData['addresses'] = $filteredAddresses->values()->all();
        }
        if (isset($validatedData['credentials'])) {
            $validatedData['credentials'] = array_filter(
                $validatedData['credentials'],
                fn($c) => !empty($c['login_url']) || !empty($c['username']) || !empty($c['password']) || !empty($c['customer_no']) || !empty($c['two_fa_status'])
            );
        }

        $contact->update($validatedData);

        return redirect()->route('admin.contacts.index')->with('success', 'Kişi başarıyla güncellendi.');
    }

    public function exportPdf(Contact $contact)
    {
        $pdf = Pdf::loadView('admin.contacts.pdf', compact('contact'));
        return $pdf->download($contact->first_name . '-' . $contact->last_name . '.pdf');
    }
}
