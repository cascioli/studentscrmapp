<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Students\StudentsTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('itscenters', 'itscenters')
    ->middleware(['auth', 'verified'])
    ->name('itscenters.list');

Route::view('courses', 'courses')
    ->middleware(['auth', 'verified'])
    ->name('courses.list');

Route::group(['prefix' => 'students', 'middleware' => ['auth', 'verified']], function () {
    Route::redirect('/', 'students/list');

    Route::get('/list', StudentsTable::class)->name('students.list');
    Route::get('/store', Password::class)->name('students.store');
    Route::get('/edit/{id}', Appearance::class)->name('students.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
