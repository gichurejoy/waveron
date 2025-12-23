<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\QuoteController;

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

// Quote Calculator
Route::get('/quote', function () {
    return view('quote');
})->name('quote');

Route::prefix('api')->group(function () {
    Route::post('quote', [QuoteController::class, 'store']);
    Route::get('features', [QuoteController::class, 'features']);
    Route::get('services/{service}', [QuoteController::class, 'getService']);
});

// Quote PDF Routes
Route::get('quotes/{quote}/pdf', [\App\Http\Controllers\QuotePDFController::class, 'generate'])->name('quotes.pdf');
Route::get('quotes/{quote}/download', [\App\Http\Controllers\QuotePDFController::class, 'download'])->name('quotes.download');

// Leads Routes
Route::get('/leads', [\App\Http\Controllers\LeadController::class, 'index'])->name('leads.index');
Route::get('/leads/{lead}', [\App\Http\Controllers\LeadController::class, 'show'])->name('leads.show');