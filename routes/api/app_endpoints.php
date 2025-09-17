<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppEndpointsController;

// TO-DO: Create middleware to validate the Authorization header
// Route::middleware(['validate.auth.header'])->prefix('/app')->group(function () {
Route::prefix('/app')->group(function () {

    Route::post('login', [AppEndpointsController::class, 'login'])->name('app.login');
    Route::post('register', [AppEndpointsController::class, 'register'])->name('app.login');
    Route::post('logout', [AppEndpointsController::class, 'logout'])->name('app.logout');
    Route::post('forgot-password', [AppEndpointsController::class, 'forgot_password'])->name('app.forgot-password');
    Route::middleware(['validate.auth.header.app'])->get('user/me', [AppEndpointsController::class, 'user_me'])->name('app.user.me');
    Route::middleware(['validate.auth.header.app'])->get('user/categories', [AppEndpointsController::class, 'user_categories'])->name('app.user.categories');


    // Reuniao
    // Route::middleware(['validate.auth.header.app'])->prefix('/reuniao')->group(function () {
    //     Route::get('', [App\Http\Controllers\AppEndpointsController::class, 'get_reunioes'])->name('app.reuniao.index');
    //     Route::post('', [App\Http\Controllers\AppEndpointsController::class, 'create_reuniao'])->name('app.reuniao.store');
    //     Route::get('local', [App\Http\Controllers\AppEndpointsController::class, 'get_reuniao_local'])->name('app.reuniao.local');
    //     Route::get('colaborador', [App\Http\Controllers\AppEndpointsController::class, 'get_reuniao_colaborador'])->name('app.reuniao.colaborador');

    // });



});
