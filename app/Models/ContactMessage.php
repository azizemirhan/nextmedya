<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'subject', 'message', 'ip', 'user_agent', 'read_at'];
    protected $casts = ['read_at' => 'datetime'];

    /* Scopes */
    public function scopeUnread($q)
    {
        return $q->whereNull('read_at');
    }

    public function scopeSearch($q, ?string $s)
    {
        if (!$s) return $q;
        return $q->where(function ($q) use ($s) {
            $q->where('name', 'like', "%$s%")
                ->orWhere('email', 'like', "%$s%")
                ->orWhere('subject', 'like', "%$s%")
                ->orWhere('message', 'like', "%$s%");
        });
    }

    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }
}

