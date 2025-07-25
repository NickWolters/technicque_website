<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ExperienceGroupController;
use App\Http\Controllers\WorkController;

use App\Models\Experience;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('api/experience/download/{id}', [ExperienceController::class, 'download']);
Route::get('api/study/{id}/download', [StudyController::class, 'download']);
Route::get('api/work/{id}/download', [WorkController::class, 'download']);
Route::get('api/contact/{id}/download', [ContactController::class, 'download']);

Route::post('contact/form', [ContactController::class, 'form']);

Route::resource('api/study', StudyController::class);
Route::resource('api/experience', ExperienceController::class);
Route::resource('api/experience_group', ExperienceGroupController::class);
Route::resource('api/work', WorkController::class);
Route::resource("api/blogs", BlogController::class);
Route::resource("api/contact", ContactController::class);
Route::resource("api/contact_request", ContactRequestController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
