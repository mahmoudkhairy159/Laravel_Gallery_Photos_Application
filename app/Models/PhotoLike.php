<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoLike extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'photo_id',
    ];

    /**
     * Get the user who liked the photo.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the photo that was liked.
     */
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Scope a query to only include likes for a specific photo.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $photoId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPhoto($query, int $photoId)
    {
        return $query->where('photo_id', $photoId);
    }

    /**
     * Scope a query to only include likes by a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if a given user has already liked a specific photo.
     *
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public static function isLikedByUser(int $userId, int $photoId): bool
    {
        return static::where('user_id', $userId)->where('photo_id', $photoId)->exists();
    }
}
