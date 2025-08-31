<?php


use Illuminate\Support\Facades\Route;


Route::prefix('/user')->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('', [App\Http\Controllers\UserController::class, 'profile'])->middleware('auth')->name('user.profile');
        Route::get('image/{uuid}', [App\Http\Controllers\UserController::class, 'profile_image'])->name('user.profile_image');
        Route::post('upload-image', [App\Http\Controllers\UserController::class, 'upload_image_profile'])->middleware('auth')->name('user.profile.upload_image');
    });

});

