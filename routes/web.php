<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// qekjo e tegon se qka ka mu shfaq, dmth psh te nav kur e prek signup, me u shfaq signup.blade.php me qata get e merr
Route::get('/', function () {
    $posts= Post::with('user')->latest()->paginate(5);
    return view('home',['posts'=>$posts]);
})->name('home');

//login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);

//signup
Route::get('/register', function () {
    return view('signup');
})->name('signup');
Route::post('/register', [UserController::class,'register']);

//edit profile
Route::get('/profile/{user}',[UserController::class,'editProfile'])->name('profile.edit');
Route::put('/profile/{user}',[UserController::class,'updateProfile']);

//myposts
Route::get('/myPosts',function(){
    // $posts = Post::where('user_id',auth()->id())->get();
    $posts = auth()->user()->usersPosts()->latest()->get();
    return view('myPosts',['posts'=>$posts]);
})->name('myPosts');
Route::post('/create-post',[PostController::class,'createPost']);
Route::get('/edit-post/{post}',[PostController::class,'editPost']);
Route::put('/edit-post/{post}',[PostController::class,'updatePost']);
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);