<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;


    public function posts()
    {
        return $this->hasMany(Post::class, 'profile_id', 'following_id')->orderBy('created_at', 'desc');
    }

}
