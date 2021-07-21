<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;



    protected $table = 'tasks';
    protected $guarded = [];
    protected $attributes = [
      'type' => 'new',
    ];
    protected $dates = [
      'viewed_at'
    ];
    protected $casts = [
        'completed' => 'boolean',
        'options' => 'array',
        'viewed_at' => 'datetime:Y-m-d',
    ];

//    protected static function boot()
//    {
//        parent::boot();
//        static::addGlobalScope('New scope',function (Builder $builder)
//        {
//            $builder->new();
//        });
//    }
    protected static function boot()
    {
        parent::boot();
        static::updating(function ($task) {
            $after = $task->getDirty();
            $task->history()->attach(auth()->id(),[
                'befor' => json_encode(Arr::only($task->fresh()->toArray(),array_keys($after))),
                'after' => json_encode($after),
            ]);
        });
    }


    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function getDoubleTypeAttribute()
    {
        return str_repeat($this->type, 4);
    }

    protected $appends = [
        'double_type'
    ];

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = ucfirst(strtolower($value));
    }

    public function box ()
    {
        return $this->hasMany(Box::class);
    }

    public function names ()
    {
        return $this->belongsToMany(Name::class,'task_names');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('completed', 0);
    }

    public function scopeOfType($query,$type)
    {
        return $query->where('type',$type);
    }

    public function scopeNew($query)
    {
        return $query->ofType('new');
    }

    public function isCompleted()
    {
        return (bool) $this->completed;
    }

    public function isNotCompleted()
    {
        return ! $this->isCompleted();
    }

    public function newCollection(array $models = [])
    {
        return new class($models) extends Collection
        {
          public function allCompleted()
          {
              return $this->filter->isCompleted();
          }
          public function allNotCompleted()
          {
              return $this->filter->isNotCompleted();
          }
        };
    }


    public function history()
    {

        return $this->belongsToMany(User::class,'histories')
            ->withPivot(['befor','after'])->withTimestamps();
    }

    public function company()
    {
        return $this->hasOneThrough(Company::class, User::class,'id','owner_id');
    }
}
