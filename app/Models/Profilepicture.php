<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profilepicture extends Model
{
    use HasFactory;
    public static $imageName;
    public static $directory;
    public static $imageUrl;
    public static $Profilepicture;

    private static function getImageURL($image){
        self::$imageName = $image->getClientOriginalName();
        self::$directory = 'Profile images/';
        $image->move(self::$directory, self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function staticImageURL()
    {
        return 'storage/images/user.png';
    }

    public static function updatePicture($image, $id){
        self::$Profilepicture = new Profilepicture();
        self::$Profilepicture->profile_id = $id;
        self::$Profilepicture->image = self::getImageURL($image);
        self::$Profilepicture->save();

        //upateing in users table
        return self::$Profilepicture->image;
    }


    public function profile(){
        return $this->belongsTo(Porfile::class);
    }
}
