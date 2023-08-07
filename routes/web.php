<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Exceptions\CustomModelNotFoundException;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Mail\PodcastCreated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test',[TestController::class,'test']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix'=>'test/posts'],function(){
    Route::resource('{post}/comments',TestController::class);
});

Route::get('posts',function(){
    // if(!Gate::allows('admin')){
    //     abort(403);
    // };
    $posts = new PostResource(Post::first());
    return response()->json($posts,200);
})->middleware('auth:api');

Route::get('comments',function(){
    $comments = Comment::all();
    dd($comments->toArray());
});

Route::get('users',function(){
    $users = new UserResource(User::find(1)->loadCount('posts'));
    return response()->json($users,200);
});

Route::get('user/{id}',function($id){
    $user = User::where('id',$id)->first();
    if(!$user){
        throw new CustomModelNotFoundException('User',$id);
    }
    dd($user);
});

Route::get('send/mail',function(){
    $user = Auth::user();
    Mail::to($user->email)->send(new PodcastCreated('Manchester United'));
})->middleware('auth');

Route::group(['middleware'=>'auth'],function(){
    Route::get('posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('posts/create',[PostController::class,'store'])->name('posts.store');
    Route::get('posts/check',[PostController::class,'check'])->name('posts.check');
    Route::get('/posts/{id}',[PostController::class,'show']);
});

// Route::domain('{username}.' . env('APP_URL'))->group(function () {
//     Route::get('post/{id}', function ($username, $id) {
//         return 'User ' . $username . ' is trying to read post ' . $id;
//     });
// });

// Route::domain('{username}.' . env('APP_URL'))->group(function () {
//     Route::get('post/{id}', function ($username, $id) {
//         return 'User ' . $username . ' is trying to read post ' . $id;
//     });
// });

require __DIR__.'/auth.php';


//today my features(27/7/2023)
// json_decoding
// accessor
// mutator
// boolean casting
// array casting
// serialization beginning