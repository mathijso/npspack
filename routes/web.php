<?php

use App\Http\Controllers\LegalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\SubscriptionController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [LegalController::class, 'terms'])->name('terms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'purchased'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('docs', 'docs')
    ->middleware(['auth', 'subscribed'])
    ->name('docs');

Route::middleware(['auth', 'verified', 'purchased'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('sites', SiteController::class)
        ->middleware(['verified', 'purchased']);
});

Route::get('/subscribe', [SubscriptionController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('subscribe');

require __DIR__.'/auth.php';
