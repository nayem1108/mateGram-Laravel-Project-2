<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postsimage extends Model
{
    use HasFactory;

    private static $postImage;
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


    public static function uploadImages($images, $id){
        
        foreach($images as $image){
            self::$postImage = new Postsimage();
            self::$postImage->post_id = $id;
            self::$postImage->image = self::getImageURL($image);
            self::$postImage->save();
        }
    }

    public static function deleteImages($postid)
    {
        self::$postImage = Postsimage::where('post_id', $postid)->get();

        foreach(self::$postImage as $postImage){
            $postImage->delete();
        }
    }


    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
