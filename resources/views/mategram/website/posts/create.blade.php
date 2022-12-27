@extends('mategram.master')

@section('content')
    <div class="row middle">
        <div class="col-md-4 mx-auto">
            <h3><strong>Add New Post</strong></h3>
        </div>
    </div>

    <div class="row middle p-5">
        <div class="col-md-12">
            <form action="{{route('post.new',['id' => $user->profile->id])}}" method="post" enctype="multipart/form-data">
                @csrf       
                
                <div class="row py-2">
                    <div class="col-md-3 p-1">
                        <label for="name"><strong>Post Caption</strong></label>
                    </div>
                    <div class="col-md-9 p-1">
                        <textarea name="caption" id="" class="form-control" rows="3" placeholder="Write your feelings..." required autofocus></textarea>
                        <span class="text-danger">{{$errors->has('caption') ? $errors->first('caption') : ''}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 p-1">
                        <label for="image"><strong>Share Image</strong></label>
                    </div>
                    <div class="col-md-9 p-1">
                        <input type="file" name="images[]" class="form-control" accept="image" multiple>
                        <span class="text-danger">{{$errors->has('images') ? $errors->first('images') : ''}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 p-1">
                        <input type="submit" class="btn btn-light btn-md" value="Post">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection