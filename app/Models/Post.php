<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
* Post Model
* @mixin Builder
*/
class Post extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'content',
        'created_at',
        'updated_at',
        'author_id'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

}
