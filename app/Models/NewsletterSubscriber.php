<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = ['email', 'status', 'token', 'ip', 'user_agent'];
    protected $casts = [];
}
