<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UploadFileTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const FILES_DIRECTORY = 'users';
    protected $guarded = [];
    protected $appends = ['image_url'];
    //status

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    //status
    protected function getImageUrlAttribute()
    {
        return $this->image ? $this->getFileAttribute($this->image) : null;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'user_id');
    }
}
