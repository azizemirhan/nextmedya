<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use SoftDeletes;

    protected $fillable = ['task_id','title','position','items_count','items_done_count'];

    public function task() { return $this->belongsTo(Task::class); }
    public function items() { return $this->hasMany(ChecklistItem::class); }
}
