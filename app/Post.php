<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    protected $guarded = [];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this -> hasMany(Comment::class);
    }
}
