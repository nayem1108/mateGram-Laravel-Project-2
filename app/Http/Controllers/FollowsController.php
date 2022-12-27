<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public static $alreadyFollow;

    public function takeUser()
    {        
        $follow_id = $_GET['id'];

        // $follower =  Follower::where('following_id', $follow_id)->get();
        $follower = auth()->user()->following;
        foreach($follower as $singleFollower){
            if(auth()->user()->id == $singleFollower->user_id && $singleFollower->following_id == $follow_id){
                $singleFollower->delete();
                return $singleFollower;
            }
            // return $follower;
        }
        $newFollower = new Follower();
        $newFollower->user_id = auth()->user()->id;
        if($follow_id == auth()->user()->profile->id)
            return;
        else{
            $newFollower->following_id = $follow_id;
            $newFollower->save();
            $follower = auth()->user()->following;
        }
        return $follower;

        
        if(auth()->user()->following->find(auth()->user()->id))
        {
            $follower = new Follower();
            $follower->user_id = auth()->user()->id;
            $follower->following_id = $follow_id;
            $follower->save();
            return response()->json($follower);
        }
        
        $following = auth()->user()->following->first()->where('following_id', $follow_id)->get()->last();
        return $following;


        if($following)
        {
            $following->delete();
            return response()->json($following);

        }
        else{
            $follower = new Follower();
            $follower->user_id = auth()->user()->id;
            $follower->following_id = $follow_id;
            $follower->save();
            return response()->json($follower);
        }



    }


    // public function store()
    // {
        
    //     return response()->json('ok');
    // }
//     if($following){
//             foreach($following as $follow)
//             {
//                 if($follow->user_id == auth()->user()->id && $follow->profile_id == $_GET['id']){
//                     self::$alreadyFollow = $follow;
//                     break;
//                 }
//             }
//             self::$alreadyFollow->delete();
//             return response()->json(self::$alreadyFollow);
//         }
//         else {
//             $follow = new Follower();
//             $follow->user_id = auth()->user()->id;
//             $follow->profile_id = $follow_id;
//             $follow->profile_id->save();
//             return response()->json($follow);
//             // return response()->json('Opps');
//         }
        
        
//         $following = Follower::where('profile_id', $follow_id)->get()->find(auth()->user()->id);

//         $post = Post::where('profile_id', 1)->get()->find(1);
//         return response()->json($post);

//         // return response()->json($following);

//         // foreach($following as $follow){
//         //     // $following->delete();
//         //     return response()->json('')
//         //     return response()->json($follow);
//         // }
//         // else{
//         //     $follow = new Follower();
//         //     $follow->user_id = auth()->user()->id;
//         //     $follow->profile_id = $follow_id;
//         //     $follow->profile_id->save();
//         //     return response()->json($follow);
//         // }

//         // $follow = Follower::find(auth()->user()->id);
        
//         // if($follow->profile_id == $follow_id && $following->user_id == auth()->user()->id)
//         //     return response()->json($follow);

//         // $allFollowing = Follower::where('following_id', $follow_id)->get()->count();
//         // return response()->json($allFollowing);
//         // if($allFollowing != null){
//         //     foreach($allFollowing as $singleFollowing)
//         //     {
//         //         if($singleFollowing->user_id == auth()->user()->id)
//         //         {
//         //             $singleFollowing->delete();
//         //             return response()->json('unfollow success');
//         //         }
//         //     }
//         // }
//         // return response()->json('Not Found');
//         // else{
//         //     $follower = new Follower();
//         //     $follower->user_id = auth()->user()->id;
//         //     $follower->following_id = $follow_id;
//         //     $follower->save();
//         //     return response()->json($follower->count());
//         // }
//         // Follower::
//         // return response()->json($following);

        

//         // if($following->profile_id == $follow_id && $following->user_id == auth()->user()->id)
//         // {
//         //     $following->delete();
//         //     return response()->json($following->count());
//         // }
        
//         // // $user->following

//         // // foreach($$user->following as $singleFollowing){
//         // //     if($singleFollowing->profile_id == $_GET['id']){
//         // //         $following->delete();
//         // //         return response()->json($following->count());
//         // //     }
//         // //     else{
//         // //         continue;
//         // //     }

//         // // }

//         // else{
//         //     $follower = new Follower();
//         //     $follower->user_id = auth()->user()->id;
//         //     $follower->following_id = $follow_id;
//         //     $follower->save();
//         //     return response()->json($follower->count());
//         // }

//     }
// }
}