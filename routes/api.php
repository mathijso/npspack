<?php

use App\Http\Controllers\Api\NpsSubmissionController; // Create this controller later
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route for anonymous NPS submissions from the widget
Route::post('/nps', [NpsSubmissionController::class, 'store'])
    ->name('api.nps.store'); // Give it a name for potential future use 