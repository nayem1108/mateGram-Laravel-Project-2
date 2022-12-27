<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') mateGram - Connect with your mates and Share Moments</title>
    <link rel="stylesheet" href="{{asset('/')}}mategram/popup/popup.css">
    <link rel="stylesheet" href="{{asset('/')}}mategram/website/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('/')}}mategram/website/static/css/style.css">
    <link rel="stylesheet" href="{{asset('/')}}mategram/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/')}}mategram/font-awesome/css/fontawesome.min.css">
</head>
<body>
    <div class="container" id="blur">
        <div class="row middle">
            <div class="col-md-12">
                <nav class="navbar navbar-expand">
                    <a href="{{ route('home') }}" class="navbar-brand text-dark" style="font-weight: bold;font-size:3ch;">mateGram</a>
                    <div class="navbar-collapse">
                        
                        @if($user)
                            <form action="{{route('search-profile')}}" method="get" class="mx-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <input type="text" name="profile" class="form-control" placeholder="Search Profile">
                                    </div>
                                    <div class="ms-2">
                                        <button type="submit" class="btn btn-light">Search</button>
                                    </div>
                                </div>
                            </form>
                            <ul class="navbar-nav ms-auto">
                                @if ($user->role == "ADMIN")
                                    <li><a href="{{ route('dashboard') }}" class="nav-link btn-sm bg-light mt-2" style="border-radius: 10px;" id="dashboard">Dashboards</a></li>
                                @endif
                                <li class="dropdown">
                                    @if ($user->profile_photo_path)
                                        <a href="" class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown"><img src="{{ asset($user->profile_photo_path)}}" class="rounded-circle" title="{{$user->username}}" height="35" width="35"></a>
                                    @else
                                    <a href="" class="nav-link dropdown-toggle text-dark" data-bs-toggle="dropdown"  style="font-size:300;">{{$user->username}}</a>
                                    @endif
                                        
                                    <ul class="dropdown-menu">
                                        @if ($user->role == "ADMIN")
                                        <li><a href="{{ route('home') }}" class="dropdown-item">Home</a></li>
                                        {{-- <li><a href="{{ route('dashboard') }}" class="dropdown-item">Dashboards</a></li> --}}
                                        @endif
                                        <li><a href="{{route('user.profile', ['username' => $user->username])}}" class="dropdown-item">My Profile</a></li>
                                        <li><a href="{{route('user.profile', ['username' => $user->username])}}" class="dropdown-item">Settings</a></li>
                                        <li class="dropdown-item">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <a href="{{ route('logout') }}" class="nav-link text-danger" onclick="event.preventDefault(); this.closest('form').submit()">Log Out</a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @else
                        <ul class="navbar-nav ms-auto">
                            <li><button href="javascript:void(0);" class="nav-link pop-up-btn bg-primary" style="color:white;" onclick="openLoginPopup();">Log In</button></li>
                            <li><a href="javascript:void(0);" class="nav-link pop-up-btn" style="background: rgb(124, 244, 244);color:black;" onclick="openRegisterPopup();">Sign Up</a></li>
                        </ul>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
        
        
        @yield('content')
    </div>
    {{-- popup contents --}}
    <div class="pop-up-container">
        <div class="pop-up" id="login-popup">
            <img src="{{asset('/')}}mategram/popup/close-btn.jpg" alt="" height="30px" class="close-img" onclick="closeLoginPopup()">
            <h2 class="pop-up-text-center">Login | mateGram</h2>
            <form action="{{asset('login')}}" class="text-center" method="post">
                @csrf
                <input type="email" name="email" autofocus="email" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="email" required>
                <input type="password" name="password" autocomplete="current-password" class="pop-up-w-100 pop-up-form-control" placeholder="password" required>
                <button type="submit" class="pop-up-btn" >Login</button><br>
            </form>
            <a href="#" onclick="openRegisterPopup()">Dont have an account ? Regsiter here</a>
        </div>
        <div class="pop-up" id="signup-popup">
            <img src="{{asset('/')}}mategram/popup/close-btn.jpg" alt="" height="30px" class="close-img" onclick="closeRegisterPopup()">
            <h2 class="text-center">Create new Account | mateGram</h2>
            <form action="{{asset('register')}}" class="text-center" method="POST">
                @csrf
                <input type="text" name="name" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="Name" required>
                <input type="text" name="username" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="Username" required><br>
                <span class="text-danger">{{$errors->has('username') ? $errors->first('username') : '' }}</span>
                <input type="email" name="email" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="Email" required>
                <span>{{$errors->has('email') ? $errors->first('email') : '' }}</span>
                <input type="password" name="password" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="Password" autocomplete="new-password" required>
                <input type="password" name="password_confirmation" class="pop-up-w-100 pop-up-mb-5 pop-up-form-control" placeholder="Confirm Password" autocomplete="new-password" required>
                <span>{{$errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                <button type="submit" name="" class="pop-up-btn" >Register</button><br>
            </form>
            <a href="javascript: void(0);" onclick="openLoginPopup()">Already Registered ? Login here</a>
        </div>
    </div>

    <script>
        var blur = document.getElementById("blur");
        let loginPopup = document.getElementById("login-popup");
        let signup_popup = document.getElementById("signup-popup");

        function openLoginPopup(){
            blur.classList.add('active');
            loginPopup.classList.add("active-pop-up");
            signup_popup.classList.remove('active-pop-up');

        }
        function closeLoginPopup(){
            blur.classList.remove('active');
            loginPopup.classList.remove("active-pop-up");
        }
        
        function openRegisterPopup(){
            blur.classList.add('active');
            signup_popup.classList.add('active-pop-up');
            loginPopup.classList.remove("active-pop-up");
        }
        function closeRegisterPopup(){
            blur.classList.remove('active');
            signup_popup.classList.remove('active-pop-up');
        }
    </script>
    <script>
        function followUser(userid) {
            // alert(userid);

            $.ajax({
                type:"GET",
                url:"{{route('profile.follow')}}",
                data:{id: userid},
                dataType: "JSON",
                success:function(response){
                    var button = document.getElementById('follow-btn');
                    var following = document.getElementById('count-following');
                    var followers = document.getElementById('count-follower');
                    // console.log(followers.innerHTML);
                    if(button.innerHTML == 'Follow'){
                    button.innerHTML = 'Unfollow'
                    }
                    else {
                    console.log(button.innerHTML);
                    button.innerHTML = 'Follow'
                    }
                    console.log(response);
                }
            });
        }         
    </script>


    {{-- scripts  --}}
    <script src="{{asset('/')}}mategram/website/assets/js/jquery-3.6.0.js"></script>
    <script src="{{asset('/')}}mategram/website/assets/js/bootstrap.bundle.js"></script>

    {{-- <script src="{{asset('/')}}mategram/website/static/js/follow-button.js"></script> --}}
    {{-- <script src="{{asset('/')}}mategram/website/static/js/validation.js"></script> --}}
    <script>
        function getImageName(imageName){

            document.getElementById("display-image").innerText = "Selected";
            document.getElementById("display-image").innerText.style = "padding-top:2px;";
        }
    </script>

</body>
</html>








