<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Contact extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'account_id',
        'profile_photo_path',
        'first_name', 'last_name', 'job_title', 'department',
        'emails', 'phones', 'addresses', 'socials', 'custom_fields',
        'credentials',
        'is_decision_maker', 'consent_email', 'consent_sms',
        'source', 'score', 'notes',
    ];

    protected $casts = [
        'emails' => 'array',
        'phones' => 'array',
        'addresses' => 'array',
        'socials' => 'array',
        'custom_fields' => 'array',
        'credentials' => 'array',
        'is_decision_maker' => 'boolean',
        'consent_email' => 'boolean',
        'consent_sms' => 'boolean',
        'score' => 'integer',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * 'credentials' alanına veri yazılırken bu metot otomatik çalışır.
     * Gelen diziyi JSON'a çevirir ve şifreleyerek kaydeder.
     *
     * @param array|null $value
     * @return void
     */
    public function setCredentialsAttribute(?array $value): void
    {
        if (empty($value) || empty(array_filter($value))) {
            $this->attributes['credentials'] = null;
        } else {
            $this->attributes['credentials'] = Crypt::encryptString(json_encode($value));
        }
    }

    /**
     * 'credentials' alanı okunurken bu metot otomatik çalışır.
     * Şifrelenmiş metni çözer ve JSON'dan PHP dizisine çevirir.
     *
     * @param string|null $value
     * @return array|null
     */
    public function getCredentialsAttribute(?string $value): ?array
    {
        if (is_null($value)) {
            return null;
        }
        try {
            return json_decode(Crypt::decryptString($value), true);
        } catch (\Exception $e) {
            return null; // Şifre çözülemezse null döndür
        }
    }

}
