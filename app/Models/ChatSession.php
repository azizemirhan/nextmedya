<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'visitor_name',
        'visitor_email',
        'visitor_ip',
        'status',
        'last_activity'
    ];

    protected $casts = [
        'last_activity' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function unreadVisitorMessages()
    {
        return $this->hasMany(ChatMessage::class)
            ->where('sender_type', 'visitor')
            ->where('is_read', false);
    }

    // Sadece bu kullanıcıya ait session'ları getir
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
