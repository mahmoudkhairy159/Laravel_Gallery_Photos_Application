<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

  /**
     * Get all galleries created by the user.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Get all photos uploaded by the user.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Get all comments made by the user on photos.
     */
    public function photoComments()
    {
        return $this->hasMany(PhotoComment::class);
    }

    /**
     * Get all likes made by the user on photos.
     */
    public function photoLikes()
    {
        return $this->hasMany(PhotoLike::class);
    }

    /**
     * Get all views (photo watch history) made by the user on photos.
     */
    public function photoWatches()
    {
        return $this->hasMany(PhotoWatch::class);
    }

    /**
     * Get all saved photos by the user.
     */
    public function photoSaves()
    {
        return $this->belongsToMany(Photo::class, 'photo_saves');
    }

    /**
     * Get all tags created or associated by the user.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tags');
    }
}
