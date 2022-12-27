<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    private static $profile;

    public static function updateProfile($request, $userprofile){
        self::$profile = Profile::find($userprofile->id);

        self::$profile->title = $request->title;
        self::$profile->description = $request->description;
        self::$profile->URL = $request->URL;
        self::$profile->save();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pictures(){
        return $this->hasMany(Profilepicture::class);
    }

    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    public function followers(){
        return $this->hasMany(Follower::class, 'following_id', 'id');
    }

}
