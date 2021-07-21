<?php

namespace App\Models;
use App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Name extends Model
{
    use HasFactory;
    protected $table = 'names';
    protected $guarded = [];



    public  function getRouteKeyName(): string
    {
        return 'name';
    }

    public function scopeIncomplete($query){
        return $query->where('completed', 0);
    }


    public function  tasks () {
        return $this->belongsToMany(Task::class,'task_names');
    }

}

