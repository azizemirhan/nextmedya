<?php

// app/Models/Contact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'emails' => 'array',
        'phones' => 'array',
        'addresses' => 'array',
        'socials' => 'array',
        'consent_email' => 'boolean',
        'consent_sms' => 'boolean',
        'consent_updated_at' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
