<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('reminders', 'reminders.index')
    ->middleware(['auth'])
    ->name('reminders.index');

Route::view('reminders/create', 'reminders.create')
    ->middleware(['auth'])
    ->name('reminders.create');


/* Route::resource('reminders', ReminderController::class)
    ->middleware(['auth', 'verified']); */

require __DIR__ . '/auth.php';
