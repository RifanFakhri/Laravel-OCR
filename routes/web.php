<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\OcrController;
use App\Http\Controllers\ComparisonController;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// OCR Routes
Route::get('/ocr', [OcrController::class, 'index'])->name('ocr.index');
Route::post('/ocr/store', [OcrController::class, 'store'])->name('ocr.store');

// Comparison Routes
Route::get('/comparison', [ComparisonController::class, 'index'])->name('comparison.index');

require __DIR__.'/settings.php';
