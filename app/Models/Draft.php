<?php

// app/Models/Draft.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'expires_at' => 'datetime',
    ];

    public function draftable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
