<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;

Route::prefix('/user')->group(function () {

    Route::prefix('/profile')->group(function () {
        Route::get('', [UserController::class, 'profile'])->middleware('auth')->name('user.profile');
        Route::get('image/{uuid}', [UserController::class, 'profile_image'])->name('user.profile_image');
        Route::post('upload-image', [UserController::class, 'upload_image_profile'])->middleware('auth')->name('user.profile.upload_image');
    });

});

