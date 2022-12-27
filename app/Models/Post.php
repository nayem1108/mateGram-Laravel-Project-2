<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    private static $post;
    public static $imageName;
    public static $directory;
    public static $imageUrl;

    private static function getImageURL($image){
        self::$imageName = $image->getClientOriginalName();
        self::$directory = 'Post images/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }



    public static function newpost($request, $profileid)
    {
        self::$post = new Post();

        self::$post->user_id = auth()->user()->id;
        self::$post->profile_id = $profileid;
        self::$post->caption = $request->caption;
        self::$post->save();

        if($request->file('images')){
            Postsimage::uploadImages($request->file('images'), self::$post->id);
        }
    }


    public static function updatePost($caption, $id){
        
        self::$post = Post::find($id);
        self::$post->caption = $caption;
        self::$post->save();
    }

    public static function deletePost($postid){

        self::$post = Post::find($postid);
        self::$post->delete();
    }

    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }


    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }


    public function images()
    {
        return $this->hasMany(Postsimage::class);
    }

}
