<?php
// app/Models/ChatMessage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'chat_session_id',
        'sender_type',
        'admin_id',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected $appends = ['formatted_time'];

    public function session()
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'admin_id');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->created_at->format('H:i');
    }
}
