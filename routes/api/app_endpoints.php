<?php
use Illuminate\Support\Facades\Route;

// TO-DO: Create middleware to validate the Authorization header
// Route::middleware(['validate.auth.header'])->prefix('/app')->group(function () {
Route::prefix('/app')->group(function () {

    Route::post('login', [App\Http\Controllers\AppEndpointsController::class, 'login'])->name('app.login');
    Route::post('register', [App\Http\Controllers\AppEndpointsController::class, 'register'])->name('app.login');
    Route::post('logout', [App\Http\Controllers\AppEndpointsController::class, 'logout'])->name('app.logout');
    Route::post('forgot-password', [App\Http\Controllers\AppEndpointsController::class, 'forgot_password'])->name('app.forgot-password');
    Route::middleware(['validate.auth.header.app'])->get('user/me', [App\Http\Controllers\AppEndpointsController::class, 'user_me'])->name('app.user.me');


    // Reuniao
    // Route::middleware(['validate.auth.header.app'])->prefix('/reuniao')->group(function () {
    //     Route::get('', [App\Http\Controllers\AppEndpointsController::class, 'get_reunioes'])->name('app.reuniao.index');
    //     Route::post('', [App\Http\Controllers\AppEndpointsController::class, 'create_reuniao'])->name('app.reuniao.store');
    //     Route::get('local', [App\Http\Controllers\AppEndpointsController::class, 'get_reuniao_local'])->name('app.reuniao.local');
    //     Route::get('colaborador', [App\Http\Controllers\AppEndpointsController::class, 'get_reuniao_colaborador'])->name('app.reuniao.colaborador');

    // });



});
