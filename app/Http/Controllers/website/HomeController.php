<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Profilepicture;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(auth());
    // }

    private static $existAvater;
    private static $followingPosts;
    
    
    public function home(){

        $user = User::find(auth()->user()->id);
        
        $existprofile = Profile::where('user_id', $user->id)->get()->first();
        // $profile;
        
        if(!$existprofile)
        {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->user->profile_photo_path = 'Profile images/user.png';
            $profile->user->save();
            $profile->save();

            
            $profilephotos = new Profilepicture();
            $profilephotos->profile_id = $profile->id;
            $profilephotos->image = $profile->user->profile_photo_path;
            $profilephotos->save();
        }

        $suggestedProfiles = User::all()->take(3);
        
        $users = auth()->user()->following->pluck('following_id');

        // $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        // $posts = Post::whereIn('user_id', $users)->latest()->get();
        $posts1 = Post::whereIn('user_id', $users)->latest()->paginate(3);
        // dd( $users);
        // dd($posts);

        // return $suggestedProfile;
        return view('mategram.website.home.home',[
            'posts1' => $posts1,
            'userProfile' => Profile::where('user_id',$user->id)->get()->last(),
            'suggestedProfiles' => $suggestedProfiles
        ]);
    }

}