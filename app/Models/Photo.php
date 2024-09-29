<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Photo extends Model
{
    use HasFactory, Filterable;
    const FILES_DIRECTORY = 'photos';

    protected $fillable = [
        'user_id',
        'body',
        'image',
        'visibility',
        'parent_photo_id'
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    /**
     * Get all comments on the photo.
     */
    public function comments()
    {
        return $this->hasMany(PhotoComment::class);
    }

    /**
     * Get all likes on the photo.
     */
    public function likes()
    {
        return $this->hasMany(PhotoLike::class);
    }

    /**
     * Get all watch records (views) on the photo.
     */
    public function watches()
    {
        return $this->hasMany(PhotoWatch::class);
    }

    /**
     * Get all tags associated with the photo.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'photo_tags');
    }

    /**
     * Get all users who saved the photo.
     */
    public function saves()
    {
        return $this->belongsToMany(User::class, 'photo_saves');
    }
    /**
     * Check if photo is saved by the current user.
     */
    public function isSaved(): bool
    {
        return $this->saves()->where('user_id', Auth::guard('user-api')->id())->exists();
    }

    /**
     * Parent photo relationship.
     */
    public function parentPhoto()
    {
        return $this->belongsTo(Photo::class, 'parent_photo_id');
    }

    /**
     * Shares relationship for shared photos.
     */
    public function shares()
    {
        return $this->hasMany(Photo::class, 'parent_photo_id');
    }
}
