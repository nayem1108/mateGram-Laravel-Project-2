@extends('mategram.admin.master');

@section('admin-title')
    Dashboard
@endsection

@section('admin-content')
<div class="row">
    Total User : {{count($user->all())}}
</div>
@endsection