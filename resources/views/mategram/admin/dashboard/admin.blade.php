@extends('mategram.admin.master')

@section('admin-title')
    Total Admin
@endsection


@section('admin-content')
    Total Admin : {{count($user->where('role', 'ADMIN')->get())}}
@endsection