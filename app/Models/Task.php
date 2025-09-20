<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Toplu atama ile doldurulabilir alanlar.
     *
     * @var array
     */
    protected $fillable = [
        'board_id',
        'list_id',
        'creator_id',
        'reporter_id',
        'title',
        'description',
        'status',
        'priority',
        'start_at',
        'due_at',
        'progress',
        'story_points',
        'cover_path',
        'position',
        'meta',
    ];

    /**
     * Otomatik tip dönüşümü yapılacak alanlar.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'due_at' => 'datetime',
        'meta' => 'array',
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    /**
     * Görevin içinde bulunduğu liste.
     * 'list' PHP'de rezerve bir kelime olduğu için metod adını 'taskList' yapmak daha güvenlidir.
     */
    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_assignees');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'task_labels');
    }

    public function watchers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_watchers');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function checklists(): HasMany
    {
        return $this->hasMany(Checklist::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(TaskActivityLog::class);
    }

    /**
     * Bu görevin ilişkili olduğu diğer görevler (örn: bu görev, diğerlerini blokluyor).
     */
    public function relatedTasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'task_id', 'related_task_id')
            ->withPivot('type')->withTimestamps();
    }

    /**
     * Bu göreve ilişkili olan diğer görevler (örn: bu görev, diğerleri tarafından bloklanıyor).
     */
    public function tasksRelatedToThis(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_relations', 'related_task_id', 'task_id')
            ->withPivot('type')->withTimestamps();
    }
}
