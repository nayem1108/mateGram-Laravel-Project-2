<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Postsimage;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(){
        return view('mategram.website.posts.create');
    }

    public function post(Request $request, $profileid){

        $request->validate([
            'caption' => 'required',
            'images' => ['required']
        ]);

        Post::newpost($request, $profileid);

        $username = auth()->user()->username;

        return redirect('/profile='.$username);
    }



    public function singlePostView($id){
        if(Post::find($id)){
            return view('mategram.website.posts.single-post-view', [
                'postuser' => User::find(Post::find($id)->user_id),
                'singlePost' => Post::find($id)
            ]);
        }
        return Post::findorfail(-1);
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        $user = User::find($post->user_id);

        if($post && $post->profile_id == auth()->user()->profile->id){
            // return 'valid user';
            return view('mategram.website.posts.edit-post',[
                'post' => Post::find($id)
            ]);
        }
        return Post::findorfail(-1);
    }


    public function updateOldPost(Request $request, $id)
    {
        if(Post::find($id)){
            Post::updatePost($request->caption, $id);
            
            if($request->file('images'))
            Postsimage::uploadImages($request->file('images'), $id);
            $username = auth()->user()->username;
            return redirect('/profile='.$username);
        }
        return Post::findorfail(-1);
    }


    public function deletePost($postid){

        $post = Post::find($postid);
        if($post && $post->profile_id == auth()->user()->profile->id){
            Post::deletePost($postid);
            Postsimage::deleteImages($postid);
            $username = auth()->user()->username;
            return redirect('/profile='.$username);
        }
        return Post::findorfail(-1);

    }
}
