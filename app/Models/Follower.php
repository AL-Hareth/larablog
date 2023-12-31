<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
* Follower Model
* @mixin Builder
*/
class Follower extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'follower_id',
        'created_at',
        'updated_at'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

}
