<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'user_id',
        'gallery_id',
        'title',
        'description',
        'image',
        'visibility',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define relationship with Gallery model
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
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
}
