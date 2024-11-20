<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:sanctum')->group(function () {
    // This route will be accessible only by authenticated users via Sanctum
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);

    //Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);


    Route::apiResource('email-messages', \App\Http\Controllers\Api\EmailMessageController::class);

});



// API routes for posts
//Route::get('posts', [\App\Http\Controllers\Api\PostController::class, 'index'])->name('posts.index');
//Route::get('posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show'])->name('posts.show');


// API routes for users
Route::get('users', [\App\Http\Controllers\Api\UserController::class, 'index'])->name('users.index');
Route::get('users/{user}', [\App\Http\Controllers\Api\UserController::class, 'show'])->name('users.show');

Route::get('email-messages', [\App\Http\Controllers\Api\EmailMessageController::class, 'index'])->name('email-messages.index');
Route::get('email-messages/{email_message}', [\App\Http\Controllers\Api\EmailMessageController::class, 'show'])->name('email-messages.show');
