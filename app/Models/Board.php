<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Toplu atama ile doldurulabilir alanlar.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'description',
        'visibility',
    ];

    /**
     * Panonun sahibi olan kullanıcı.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Panoya üye olan kullanıcılar (pivot tablo üzerinden).
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'board_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Panoya ait olan listeler.
     */
    public function lists(): HasMany
    {
        // Not: List modelinin adını `App\Models\TaskList` gibi farklı bir şey yaptıysan
        // burayı ona göre güncellemelisin.
        return $this->hasMany(TaskList::class, 'board_id');
    }

    /**
     * Panoya ait olan tüm görevler.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'board_id');
    }

    /**
     * Panoda tanımlı olan etiketler.
     */
    public function labels(): HasMany
    {
        return $this->hasMany(Label::class, 'board_id');
    }
}
