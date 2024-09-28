<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoWatch extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo_id',
        'user_id',
        'watched_at',
        'user_agent',
        'ip_address',
    ];

    /**
     * Get the photo that was watched.
     */
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Get the user who watched the photo, if any.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }

    /**
     * Scope a query to only include watches for a specific photo.
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
     * Scope a query to only include watches by a specific user.
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
     * Check if a given user has already watched a specific photo.
     *
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public static function isWatchedByUser(int $userId, int $photoId): bool
    {
        return static::where('user_id', $userId)->where('photo_id', $photoId)->exists();
    }

    /**
     * Get the formatted watched date for display.
     *
     * @return string
     */
    public function getFormattedWatchedAtAttribute(): string
    {
        return $this->watched_at ? $this->watched_at->format('M d, Y H:i A') : '';
    }
}
