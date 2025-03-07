<?php

use App\Livewire\Courses\CoursesTable;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Itscenters\CreateIts;
use App\Livewire\Itscenters\EditIts;
use App\Livewire\Itscenters\ItsTable;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Students\CreateStudent;
use App\Livewire\Students\EditStudent;
use App\Livewire\Students\StudentsTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['prefix' => 'itscenters', 'middleware' => ['auth', 'verified']], function () {
    Route::redirect('/', 'itscenters/list');

    Route::get('/list', ItsTable::class)->name('its.list');
    Route::get('/store', CreateIts::class)->name('its.store');
    Route::get('/edit/{id}', EditIts::class)->name('its.edit');
});

Route::group(['prefix' => 'courses', 'middleware' => ['auth', 'verified']], function () {
    Route::redirect('/', 'courses/list');

    Route::get('/list', CoursesTable::class)->name('courses.list');
    Route::get('/store', CreateCourse::class)->name('courses.store');
    Route::get('/edit/{id}', EditCourse::class)->name('courses.edit');
});

Route::group(['prefix' => 'students', 'middleware' => ['auth', 'verified']], function () {
    Route::redirect('/', 'students/list');

    Route::get('/list', StudentsTable::class)->name('students.list');
    Route::get('/store', CreateStudent::class)->name('students.store');
    Route::get('/edit/{id}', EditStudent::class)->name('students.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
