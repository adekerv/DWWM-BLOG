<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Builder\Function_;

class Article extends Model
{
    protected $table = 'articles';

    public function category() : BelongsTo {
    return $this->belongsTo(Article::class);

    public function user() : BelongsTo {
    return $this->belongsTo(User::class);

    }
}
