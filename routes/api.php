<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Carrega todos os arquivo existentes em base_api
foreach (glob(__DIR__ . '/api/*.php') as $filename) {
    require_once $filename;
}
