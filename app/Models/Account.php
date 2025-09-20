<?php

// app/Models/Account.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = [];

    protected $casts = [
        'emails' => 'array', 'phones' => 'array', 'addresses' => 'array',
        'socials' => 'array', 'custom_fields' => 'array',
        'last_contacted_at' => 'datetime', 'next_activity_at' => 'datetime',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
