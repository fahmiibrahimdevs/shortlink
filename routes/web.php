<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/{shortCode}', function ($shortCode) {
    if (in_array($shortCode, ['dashboard', 'profile', 'login', 'register', 'forgot-password', 'reset-password', 'verify-email', 'confirm-password'])) {
        abort(404);
    }
    
    $link = \App\Models\Link::where('short_code', $shortCode)->firstOrFail();
    $link->increment('clicks');
    
    return redirect()->away($link->original_url);
})->where('shortCode', '[a-zA-Z0-9]+');
