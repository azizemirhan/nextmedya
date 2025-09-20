<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['checklist_id','text','is_done','position'];
    protected $casts = ['is_done'=>'boolean'];

    public function checklist() { return $this->belongsTo(Checklist::class); }
}
