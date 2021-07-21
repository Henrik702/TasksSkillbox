<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
