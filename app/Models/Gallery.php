<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'name',
        'description',
        'visibility',
        'image',
        'user_id',

    ];

   /**
     * Get the user who owns the gallery.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all photos that belong to the gallery.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    

}
