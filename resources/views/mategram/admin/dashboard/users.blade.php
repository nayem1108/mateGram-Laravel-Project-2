@extends('mategram.admin.master')

@section('admin-title')
    Manage Users
@endsection


@section('admin-content')
    Total Admin : {{count($user->where('role', '!=' ,'ADMIN')->get())}}
@endsection