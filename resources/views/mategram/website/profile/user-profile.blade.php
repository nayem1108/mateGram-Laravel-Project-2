@extends('mategram.master')

@section('content')
    <div class="row middle">
        <div class="col-md-3 p-5">
            {{-- <img src="{{asset('/')}}storage/images/cr7.jpg" class="rounded-circle w-100" height="200"> --}}
            {{-- <img src="{{asset($userProfile->profilepictures->last()->avaters )}}" class="rounded-circle w-100" height="200"> --}}
            @if ($userProfile->pictures->first())
                <img src="{{asset($userProfile->pictures->last()->image) }}" class="rounded-circle align-items-center" height="200" width="200" >
            @else
            <span class="text-danger text-center">No Image </span>
            @endif
        </div>
        <div class="col-md-9 p-5">
            {{-- username  --}}
            @if (auth()->user())
                @if ($user->username == $theuser->username)
                    <div class="col-md-12">
                        <div class="d-flex align-items-baseline justify-content-between">
                            <div class="">
                                <strong><span class="font-weight-bold">{{$theuser->username}}</span></strong>
                            </div>
                            <div class="">
                                <a href="{{ route('post.create') }}" class="btn btn-light btn-sm">Create Post</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 justify-inline p-1">
                        <a href="{{route('profile.view', ['id' => $user->id])}}" class="btn btn-light btn-sm">Edit Profile</a>
                    </div>
                    @else
                    <div class="col-md-8 pb-1">
                        <div class="d-flex align-items-center">
                            <div class="pe-2">
                                <strong><span class="font-weight-bold">{{$theuser->username}}</span></strong>
                            </div>
                            <div>
                                {{-- {{$user->following->where('following_id', $theuser->id)}}
                                <h1>{{$theuser->id}}</h1> --}}
                                @if ($user->following->where('following_id', $theuser->id)->first())
                                    <button class="btn btn-primary btn-sm" value="{{$theuser->profile->id}}" id="follow-btn" onclick="followUser(this.value)">Unfollow</button>
                                @else
                                <button class="btn btn-primary btn-sm" value="{{$theuser->profile->id}}" id="follow-btn" onclick="followUser(this.value)">Follow</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-2">
                    </div> --}}
                @endif
            @else 
            <div class="col-md-8 pb-1">
                <div class="d-flex align-items-center">
                    <div class="pe-2">
                        <strong><span class="font-weight-bold">{{$theuser->username}}</span></strong>
                    </div>
                    <div>
                        <a href="javascipt: void(0);" class="btn btn-primary btn-sm text-decoration-none" onclick="openLoginPopup();">Follow</a>
                    </div>
                </div>
            </div>
            @endif

            {{-- post, followers && following  --}}
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex align-items-center ">
                        <p class="pe-4"><strong>{{count($userProfile->posts)}}</strong> posts</p>
                        <p class="pe-4" id="count-follower"><strong>{{count($userProfile->followers) }}</strong> followers</p>
                        {{-- {{$theuser}} --}}
                        <p class="pe-4" id="count-following"><strong >{{count($theuser->following)}}</strong> following</p>

                    </div>
                </div>
            </div>
            {{-- name --}}
            <div class="row">
                <div class="col-md-12">
                    <h5>{{$theuser->name}}</h5>
                </div>
            </div>
            {{-- profile title --}}
            <div class="row">
                <div class="col-md-12">
                    <p>{{$userProfile->title ? $userProfile->title : ''}}</p>
                </div>
            </div>
            {{-- profile description  --}}
            <div class="row">
                <div class="col-md-10">
                    <p class="">{{$userProfile->description ? $userProfile->description : ''}}</p>
                </div>
            </div>
            {{-- profile URL  --}}
            <div class="row">
                <div class="col-md-12">
                    <a href="{{$userProfile->URL ? $userProfile->URL : 'jasvascrtipt: void(0);'}}" target="__blank" class="text-dark" style="text-decoration: none; font-weight: bold;">{{$userProfile->URL ? $userProfile->URL : ''}}</a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($userProfile->posts as $userpost)
                @if ($userpost->images)
                    <div class="col-md-4 mt-4">
                        <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="2100" id="slider">
                            {{-- <a href=""></a> --}}
                            <div class="carousel-inner">
                                @foreach ($userpost->images as $post)
                                    @if($userpost->images->first()->image == $post->image)
                                    <div class="carousel-item active">
                                        <a href="{{ route('post.view', ['id' => $userpost->id ])}}"><img src="{{asset($post->image)}}" class="w-100" height="300"></a>
                                    </div>
                                    @else
                                    <div class="carousel-item">
                                        <a href="{{ route('post.view', ['id' => $userpost->id ])}}"><img src="{{asset($post->image)}}" class="w-100" height="300"></a>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                {{-- @else
                    @continue --}}
                @endif
            @endforeach
        </div>
    </div>
@endsection
