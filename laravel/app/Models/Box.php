<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $table = 'boxes';
    protected $guarded = [];

    public function scopeIncomplete($query){
        return $query->where('completed', 0);
    }

    public function task () {
        return $this->belongsTo(Task::class,'task_id');
    }

}
