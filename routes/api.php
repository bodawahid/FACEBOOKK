<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\facebookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('web')->group(function () {
    // get all data (user information , some posts) ;
    Route::get('/retrieve/data', [facebookController::class, 'getData'])->name('get.data');
    Route::post('/create/post', [PostController::class, 'create'])->name('create.post');
    Route::post('/edit/post', [PostController::class, 'editPost'])->name('edit.post');
    Route::delete('/softDelete/post', [PostController::class, 'softDelete'])->name('soft.delete.post');
    Route::get('/permenantDelete/{post}/post', [PostController::class, 'permenantDelete'])->name('permenant.delete.post');
    Route::post('/share/post', [PostController::class, 'sharePost'])->name('share.post');


    Route::delete('/delete/dssfssjdfjksdkjsjfdjdsfj',[CommentController::class,'create'])->name('deleteComment');

    // users profiles 
    // get current user data 
    Route::get('/current/user/profile/data', [UserController::class, 'currentUserData'])->name('user.profile.data');
    Route::post('/current/user/posts', [UserController::class, 'getUserPosts'])->name('posts.data');
    // like and dislike post 
    Route::post('/add/likes',[PostController::class,'addPostLikes'])->name('update.likes');
    Route::post('/remove/likes',[PostController::class,'removePostLikes'])->name('update.likes');
    // get reacts info 
    Route::post('/get/reacts/info',[PostController::class,'getReactsInfo'])->name('get.reacts.info') ;
    // follow route
    Route::post('follow/people',[UserController::class,'follow'])->name('follow.people');
    // unfollow route
    Route::post('unfollow/people', [UserController::class, 'unfollow'])->name('unfollow.people');
    // checking if the authenticated user follows another user
    Route::get('/is-following/{userId}', [UserController::class, 'isFollowing'])->name('is-following');
    // get followers
    Route::post('/followers', [UserController::class, 'getFollowers'])->name('get.followers');
    // get following
    Route::post('/following', [UserController::class, 'getFollowing'])->name('get.following');


});
