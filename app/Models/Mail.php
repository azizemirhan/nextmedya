<?php

// app/Models/Mail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Gönderen kullanıcı ilişkisi
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Alıcı kullanıcı ilişkisi
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
