<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this -> belongsTo(Post::class);
    }
}
