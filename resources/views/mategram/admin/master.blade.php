@extends('mategram.master')

@section('title')
    @yield('admin-title') |
@endsection

@section('content')

<div class="row mt-0 pt-0">
    <div class="col-md-3">
        <nav class="navbar navbar-light bg-light">
            <ul class="navbar-nav">
                <li><a href="{{route('dashboard')}}" class="nav-link">Dashboard</a></li>
                <li><a href="{{route('manage-admin')}}" class="nav-link">Admin</a></li>
                <li><a href="{{route('manage-user')}}" class="nav-link">Users</a></li>
            </ul>
        </nav>
    </div>
    <div class="col-md-9">
        @yield('admin-content')
    </div>
</div>
@endsection