<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
//    protected $visible = [
//        'name'
//    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class,'owner_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class,'owner_id')->withDefault(['name'=> 'неет компании']);
    }


    protected $appends = [
        'is_admin'
    ];

    public function getIsAdminAttribute()
    {
        return (bool) rand(0,2);
    }
    public function getIsMenegerAttribute()
    {
        return (bool) rand(3,6);
    }

    public function box ()
    {
        return $this->hasManyThrough(Box::class,Task::class,'owner_id');
    }

    public function avatar()
    {
        return $this->morphOne(Image::class,'imageable');
    }
}
