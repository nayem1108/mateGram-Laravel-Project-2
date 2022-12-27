<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\website\HomeController;
use App\Http\Controllers\website\PostController;
use App\Http\Controllers\website\ProfileController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/profile={username}', [ProfileController::class, 'index'])->name('user.profile');
Route::get('/p/slkj24309jk34/post=djkwiue820{id}03p08uj', [PostController::class, 'singlePostView'])->name('post.view');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
->group(function () {
    //website routes
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/profileid={id}', [ProfileController::class, 'editProfile'])->name('profile.view');
    Route::post('/update/id={id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/search-profile}', [ProfileController::class, 'searchProfile'])->name('search-profile');

    Route::get('p/create-post', [PostController::class, 'createPost'])->name('post.create');
    Route::post('p/create-new-post/{id}', [PostController::class, 'post'])->name('post.new');
    Route::get('p/edit-post/post-id={id}', [PostController::class, 'editPost'])->name('post.edit');
    Route::post('p/update-post/post-id={id}', [PostController::class, 'updateOldPost'])->name('update.post');
    Route::get('p/delete-post/post-id={id}', [PostController::class, 'deletePost'])->name('delete.post');

    Route::get('/follow-user', [FollowsController::class, 'takeUser'])->name('profile.follow');
    Route::get('/set-user-following', [FollowsController::class, 'store'])->name('profile.setFollow');


    // admin routes
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage-admin', [AdminController::class, 'manageAdmin'])->name('manage-admin');
    Route::get('/manage-users', [AdminController::class, 'manageUser'])->name('manage-user');
});
