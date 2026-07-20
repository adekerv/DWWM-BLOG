<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $table = 'articles';

    /*
     * The attributes that should be cast.
     * Tells Laravel to treat published_at as a Carbon datetime object.
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /*
     * Relationship with the Category model
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /*
     * Relationship with the User model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}