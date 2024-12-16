<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Services Pages
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/services/software-development', function () {
    return view('softwaredevelopment');
})->name('services.software');

Route::get('/services/graphic-design', function () {
    return view('graphicdesign');
})->name('services.design');

Route::get('/services/branding', function () {
    return view('branding');
})->name('services.branding');

Route::get('/services/digital-marketing', function () {
    return view('digitalmarketing');
})->name('services.marketing');

Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('terms-of-service');
})->name('terms-of-service');