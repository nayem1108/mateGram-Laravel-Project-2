<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\FollowMethod;
use App\Models\Profile;
use App\Models\Profilepicture;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    private $sa;
    public function index($username)
    {
        // $userfollowing =  auth()->user()->following;
        // return $userfollowing->first()->where('following_id', 7)->get()->first();
        
        // $theuser = User::where('username', $username)->get()->find(auth()->user()->id);
        $theuser = User::where('username', $username)->get()->last();


        if($theuser){

            return view('mategram.website.profile.user-profile', [
                'theuser' => $theuser,
                'userProfile' =>Profile::where('user_id', $theuser->id)->get()->first(),
            ]);  
        }
        else{
            User::findorfail(0);
        }
        // return redirect()->back()->with('message', 'User not found');
    }


    public function editProfile($id){

        $user = User::find($id);
        $this->authorize('update', $user->profile);
        return view('mategram.website.profile.edit-profile',[
            'theuser' => $user,
            'userProfile' => Profile::find($id)
        ]);
    }

    public function update(Request $request, $id){

        // $request->validate([
        //     // 'title' => ['required', 'string'],
        //     // 'URL' => 'url'
        // ]);

        $user = User::find($id);
        $userProfile = Profile::where('user_id', $user->id)->get()->first();

        if($request->file('avater')){
            $user->profile_photo_path = "";
            $imageUrl = Profilepicture::updatePicture($request->file('avater'), $userProfile->id);
            $user->profile_photo_path = $imageUrl;
            $user->save();
        }

        if($request->name || $request->username){
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();
        }

        Profile::updateProfile($request, $userProfile);

        $username = auth()->user()->username;
        return redirect('/profile='.$username);
    }


    public function searchProfile(Request $request){
        $profile = User::where('username', $request->profile)->get()->last();
        if($profile){
            return redirect('/profile='.$request->profile);
        }
        else{
            User::findorfail(0);
        }
    }
}
