<?php

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

    // users profiles 
    // get current user data 
    Route::get('current/user/profile/data', [UserController::class, 'currentUserData'])->name('user.profile.data');
    Route::get('current/user/{user_Id}/posts', [UserController::class, 'getUserPosts'])->name('posts.data');
});
