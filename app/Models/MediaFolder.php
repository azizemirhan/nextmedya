<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MediaFolder extends Model
{
    use HasFactory;


    protected $fillable = ['name','slug','parent_id','path','visibility'];


    public function parent(){ return $this->belongsTo(self::class, 'parent_id'); }
    public function children(){ return $this->hasMany(self::class, 'parent_id'); }
    public function galleries(){ return $this->hasMany(Media::class, 'folder_id'); }
}
