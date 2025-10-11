<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'username',
        'image',
        'phone',
        // YENİ EKLENEN ALANLAR
        'profession',
        'country',
        'address',
        'location',
        'website',
        'socials',
        'notes',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'socials' => 'array', // socials sütununu otomatik olarak diziye çevirir
    ];

    public function boards(): BelongsToMany
    {
        return $this->belongsToMany(Board::class, 'board_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function sentMails()
    {
        return $this->hasMany(Mail::class, 'sender_id');
    }

    public function receivedMails()
    {
        return $this->hasMany(Mail::class, 'recipient_id');
    }


}
