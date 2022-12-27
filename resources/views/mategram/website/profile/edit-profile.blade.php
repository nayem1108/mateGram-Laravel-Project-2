@extends('mategram.master')
@section('title')
    {{$user->username}} | 
@endsection


@section('content')
    <div class="row middle">
        <div class="col-md-12 p-2 text-center">
            <h3><strong>Update Profile</strong></h3>
        </div>
    </div>

    <div class="row middle">
        <div class="col-md-12">
            <form action="{{route('profile.update',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                @csrf       
                <div class="row">
                    <div class="col-md-4 mx-auto">
                        @if($user->profile->pictures) {{--->pictures->first()->image--}}
                            <img src="{{asset($userProfile->pictures->last()->image) }}" class="rounded-circle items-center" height="200" width="200" >
                        @else
                            <p class="py-2 text-center text-danger">NO IMAGE</p>
                        @endif
                        <input type="file" name="avater" class="p-3" accept="image">
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-10 mx-auto">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-10 mx-auto">
                        <label for="username"><strong>username</strong></label>
                        <input type="text" id="username" name="username" class="form-control" value="{{$user->username}}" readonly>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-10 mx-auto">
                        <label for="profile-title"><strong>Profile Caption</strong></label>
                        <input type="text" id="profile-title" name="title" class="form-control" value="{{$userProfile->title}}">
                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title') : ''}}</span>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-10 mx-auto">
                        <label for="profile-description"><strong>Profile Description</strong></label>
                        @if ($userProfile->description)
                            <textarea name="description" id="profile-description" class="form-control" value="{{$userProfile->description}}">{{$userProfile->description}}</textarea>
                        @else
                            <textarea name="descrpition" id="profile-description" class="form-control" placeholder="Description goes here"></textarea>                            
                        @endif
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-10 mx-auto">
                        <label for="url"><strong>URL</strong></label>
                        <input type="text" id="url" name="URL" class="form-control" value="{{$userProfile->URL}}">
                        <span class="text-danger">{{$errors->has('URL') ? $errors->first('URL') : ''}}</span>

                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-4 mx-auto">
                        <input type="submit" class="btn btn-success btn-sm" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection