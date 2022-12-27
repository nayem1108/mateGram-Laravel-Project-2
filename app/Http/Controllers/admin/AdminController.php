<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{

    public function dashboard(){
        if(auth()->user()->role == 'ADMIN')
        {
            $message = Session::put('Welcome Back, Admin !! ');
            return view('mategram.admin.dashboard.dashboard', ['welcome-message' => $message]);
        }
        return redirect('/');
    }
    public function manageAdmin(){
        if(auth()->user()->role == 'ADMIN')
        {
            return view('mategram.admin.dashboard.admin');
        }
        return redirect('/');
    }

    public function manageUser(){
        if(auth()->user()->role == 'ADMIN')
        {
            return view('mategram.admin.dashboard.users');
        }
        return redirect('/');
    }
}
