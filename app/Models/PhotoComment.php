<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoComment extends Model
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
        'comment',
        'parent_comment_id',
    ];

    /**
     * Get the user who created the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the photo on which the comment was made.
     */
    public function photo(): BelongsTo
    {
        return $this->belongsTo(Photo::class);
    }

    /**
     * Get the parent comment (if it's a reply to another comment).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(PhotoComment::class, 'parent_comment_id');
    }

    /**
     * Get all replies for the comment.
     */
    public function replies()
    {
        return $this->hasMany(PhotoComment::class, 'parent_comment_id');
    }

    /**
     * Scope a query to only include top-level comments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_comment_id');
    }

    /**
     * Scope a query to only include comments for a specific photo.
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
     * Scope a query to only include comments made by a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }


}
