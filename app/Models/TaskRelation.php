<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskRelation extends Model
{
    protected $fillable = ['task_id','related_task_id','type'];

    public function task() { return $this->belongsTo(Task::class,'task_id'); }
    public function relatedTask() { return $this->belongsTo(Task::class,'related_task_id'); }
}
