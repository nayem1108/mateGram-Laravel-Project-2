@extends('mategram.master')

@section('content')
    <div class="row middle">
        <div class="col-md-4 mx-auto">
            <h3><strong>Update Current Post</strong></h3>
        </div>
    </div>

    <div class="row middle p-5">
        <div class="col-md-12">
            <form action="{{route('update.post', ['id' => $post->id])}}" method="post" enctype="multipart/form-data">
                @csrf       
                <div class="row py-2">
                    <div class="col-md-9 mx-auto">
                        <textarea id="" class="form-control" rows="3" name="caption">{{$post->caption}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto pb-2">
                        @if($post->images)
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <div class="d-flex align-items-center">
                                        @foreach ($post->images as $post)
                                        <div class="p-1">
                                            <img src="{{asset($post->image)}}" class="w-100" style="border-radius: 5px;" height="120">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                        no image
                        @endif
                    </div>
                </div>
                <div class="col-md-9 mx-auto">
                    <input type="file" name="images[]" accept="image" multiple>
                    
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto text-center">
                        <input type="submit" class="btn btn-success btn-sm" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection