@extends('mategram.master')

@section('title')
    {{$postuser->username}}'s Post |
@endsection

@section('content')
    <section class="middle">
        <div class="row">
            <div class="col-md-8">
                @if ($singlePost->images)
                    <div class="row">
                        <div class="col-md-9 mx-auto p-2">
                            <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" id="slider">
                                <div class="carousel-inner">
                                    @foreach ($singlePost->images as $post)
                                        @if ($singlePost->images->first()->image == $post->image )
                                            <div class="carousel-item px-1 active">
                                                <img src="{{asset($post->image)}}" alt="" class="w-100" style="border-radius: 10px" height="543">
                                            </div>
                                        @else
                                        <div class="carousel-item px-1">
                                            <img src="{{asset($post->image)}}" alt="" class="w-100" style="border-radius: 10px" height="543">
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a href="#slider" class="carousel-control-prev" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a href="#slider" class="carousel-control-next" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-md-9 p-2 mx-auto">
                        <img src="{{asset($singlePost->images->first()->image)}}" alt="" class="w-100" style="border-radius: 10px" height="543">
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-4 p-3">
                <div class="d-flex align-items-center">
                    @if ($postuser->profile->pictures)
                    <div class="me-2">
                        <img src="{{asset($postuser->profile->pictures->last()->image)}}" class="rounded-circle" height="35" width="35">
                    </div>
                    @endif
                    <div>
                        <div class="font-weight-bold" style="font-weight:bold;">
                            <div class="d-flex align-items-center mb-1">
                                <div class="me-1">
                                    <a href="{{route('user.profile', ['username' => $postuser->username])}}" class="text-dark text-decoration-none">{{$postuser->username}}</a>
                                </div>
                                @if ($user && $user->username == $postuser->username)
                                <div class="ms-5">
                                    <a href="{{ route('post.edit', ['id' => $singlePost->id]) }}" class="btn bg-light btn-sm me-1"><i class="fa fa-edit">Edit</i></a>
                                </div>
                                <div>
                                    <a href="{{ route('delete.post', ['id' => $singlePost->id]) }}" class="btn bg-danger btn-sm"><i>Delete</i></a>
                                </div>
                                @else
                                @if ($user)
                                    @if ($user->following->where('following_id', $postuser->id)->first())
                                        <button class="btn btn-primary btn-sm" value="{{$postuser->profile->id}}" id="follow-btn" onclick="followUser(this.value)">Unfollow</button>
                                    @else
                                    <button class="btn btn-primary btn-sm" value="{{$postuser->profile->id}}" id="follow-btn" onclick="followUser(this.value)">Follow</button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm" onclick="alert('You must login first');" >Follow</a>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <p>@<span class="font-weight-bold" style="font-weight:bold;"><a href="{{route('user.profile', ['username' => $postuser->username])}}" class="text-dark text-decoration-none me-2">{{$postuser->username}}</a></span>{{$singlePost->caption}}</p>
                <div>
                    tags 
                </div>
                <div class="row py-3">
                    @if (auth()->user())
                        <div class="col-md-12">
                            <button class="btn btn-sm px-2 me-3" style="background-color:rgb(234, 234, 234);">Like</button>
                            <button class="btn btn-sm px-2 me-3" style="background-color:rgb(234, 234, 234);">Comment</button>
                            <button class="btn btn-sm px-2 me-3" style="background-color:rgb(234, 234, 234);">More</button>
                        </div>
                    @else
                        <div class="col-md-12">
                            <button class="btn btn-sm px-2 me-3" onclick="alert('You must log in first')" style="background-color:rgb(234, 234, 234);"><a href="{{route('login')}}" class="text-decoration-none text-dark">Like</a></button>
                            <button class="btn btn-sm px-2 me-3" onclick="alert('You must log in first')" style="background-color:rgb(234, 234, 234);"><a href="{{route('login')}}" class="text-decoration-none text-dark">Comment</a></button>
                            <button class="btn btn-sm px-2 me-3" onclick="alert('You must log in first')" style="background-color:rgb(234, 234, 234);"><a href="{{route('login')}}" class="text-decoration-none text-dark">More</a></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection