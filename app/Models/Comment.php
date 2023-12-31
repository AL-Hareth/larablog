<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
* Comments Model
* @mixin Illuminate\Database\Eloquent\Builder
*/
class Comment extends Model
{
    use HasFactory;

    public function user() { // commenter
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

}
