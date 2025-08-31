<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/termos-uso-app', function () {
    return Inertia::render('TermsOfService');
})->name('terms.service');

Route::get('/politica-privacidade-app', function () {
    return Inertia::render('PrivacyPolicy');
})->name('policy.privacy');

