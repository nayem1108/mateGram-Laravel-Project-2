@extends('mategram.master')


@section('content')
<div class="row">
    <div class="col-md-12 p-4">
        <form action="{{route('post.new', ['id' => auth()->user()->id ])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row middle">
                <div class="col-md-12">
                    <div class="d-flex align-items-center">
                        <div>
                            @if (auth()->user()->profile_photo_path)
                            <a href="{{route('user.profile', ['username' => auth()->user()->username])}}"><img src="{{ asset(auth()->user()->profile_photo_path)}}" class="rounded-circle" title="{{auth()->user()->username}}" height="70" width="70"></a>
                            @else
                            <a href="{{route('user.profile', ['username' => auth()->user()->username])}}" class="nav-link text-center text-dark p-4" style="font-size:300;">{{auth()->user()->username}}</a>
                            @endif
                        </div>
                        <div class="p-2">
                            {{-- <input type="text" name="caption" class="form-control-text" style="border-radius:50px;" placeholder="Share a Moment ..." required> --}}
                            <textarea name="caption" id="" cols="80" rows="1" class="form-control" style="border-radius:50px;" placeholder="Share a Moment ..." required></textarea>
                        </div>
                        <div class="pe-2">
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    <label for="fileimage" title="Upload images"><i class="fa-solid fa-file-image mb-0" style="font-size: 35px; cursor:pointer;"></i></label>
                                    <input type="file" name="images[]" id="fileimage" accept="image" multiple style="display: none;v isibility:none;" onchange="getImageName(this.value)">
                                    <span class="text-danger">{{$errors->has('images') ? $errors->first('images') : ''}}</span>
                                </div>
                                <div id="display-image" style="">
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-md bg-light text-dark p-1" value="Post">
                        </div>   
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    
    <section class="middle">
        <div class="row">
            <div class="col-md-12">
                <h6 class="p-3"><strong>Suggested Profiles</strong></h6>
            </div>
            @if (count($userProfile->posts) > 5)
                <div class="col-md-3 pb-3 text-center">
                        <img src="{{asset('/')}}storage/images/cr7.jpg" class="rounded-circle" height="150" width="150">
                    <div class="text-center py-2">
                        <strong>Cristiano</strong>  <span><a href="" style="text-decoration: none;" id="follow"><strong style="color: aqua;border-radius:10px;" class="bg-light">Follow</strong></a></span>
                    </div>
                </div>
            @else
                @if ($user->role == 'ADMIN')
                @else
                    <div class="row text-center">
                        @foreach ($suggestedProfiles as $suggestedProfile)
                            {{-- {{$suggestedProfile}}
                            {{auth()->user()}} --}}
                            @if ($suggestedProfile->id == auth()->user()->id)
                                @continue;
                            @else    
                                <div class="col-md-3">
                                    <div class="w-100">
                                        <img src="{{asset($suggestedProfile->profile_photo_path)}}" class="rounded-circle" height="150" width="150">
                                    </div>
                                    <div class="text-center py-2">
                                        <a href="{{route('user.profile', ['username' => $suggestedProfile->username])}}" class="nav-link text-dark"><strong>{{$suggestedProfile->username}}</strong></a>
                                        @if ($user->following->where('following_id', $suggestedProfile->id)->first())
                                        <button class="btn btn-primary btn-sm" value="{{$suggestedProfile->id}}" id="follow-btn" onclick="followUser(this.value)">Unfollow</button>
                                        @else
                                        <button class="btn btn-primary btn-sm" value="{{$suggestedProfile->id}}" id="follow-btn" onclick="followUser(this.value)">Follow</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
        <hr class="text-warning">
    </section>

    <section class="middle pt-2">
        <div>
        @if (auth()->user()->following->count() > 0)
            @foreach($posts1 as $post)
                {{-- {{$post->user->username}} --}}
                <div class="row">
                    {{-- {{$post}} --}}
                    <div class="col-md-8 mx-auto my-3 pb-3 bg-light" style="border-radius:10px;">
                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <img src="{{ asset($post->profile->pictures->last()->image) }}" class="rounded-circle" height="40" width="40">
                                        </div>
                                        <div>
                                            <a href="{{route('user.profile', ['username' => $post->user->username])}}" class="text-dark text-decoration-none"><strong>{{$post->user->username}}</span></a>
                                        </div>
                                        <div class="ms-2">
                                            @if (auth()->user())
                                                @if (auth()->user()->following->where('following_id', $post->user->id)->first())
                                                    <button class="btn btn-primary btn-sm" value="{{$post->user->id}}" id="follow-btn" onclick="followUser(this.value)">Unfollow</button>
                                                @else
                                                    <button class="btn btn-primary btn-sm" value="{{$post->user->id}}" id="follow-btn" onclick="followUser(this.value)">Follow</button>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm" onclick="alert('You must login first');" >Follow</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row ms-1">
                                    <span class="" style="font-weight: 450;"> {{$post->caption}}</span>
                                    {{-- {{$post->caption}} --}}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 px-0">
                                @if(count($post->images) > 1)
                                <div class="carousel slide" data-bs-ride="carousel" data-bs-interval="0" id="slider">
                                    <div class="carousel-inner">
                                        @foreach ($post->images as $singlepost)
                                            @if ($post->images->first()->image == $singlepost->image)
                                            <div class="carousel-item px-1 active">
                                                <img src="{{asset($singlepost->image)}}" alt="" class="w-100">
                                                {{-- <img src="{{asset($singlepost->image)}}" alt="" class="w-100" style="border-radius: 10px" height="543"> --}}
                                            </div>
                                            @else
                                            <div class="carousel-item px-1">
                                                <img src="{{asset($singlepost->image)}}" alt="" class="w-100" style="">
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
                                @else
                                <img src="{{asset($post->images->first()->image)}}" alt="" class="w-100" style="">
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="me-2">
                                    <button class="btn btn-sm bg-white px-5">Like</button>
                                </div>
                                <div class="me-2">
                                    <button class="btn btn-sm bg-white px-5">Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        <div class="row">
            <div class="col-md-12">
                {{ $posts1->links()}}
            </div>
        </div>
        @else
        <p class="text-center mx-5">Connect with Mates to get Posts</p>
        @endif
    </div>
    </section>
@endsection