<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentAuthController;
use App\Http\Controllers\API\StudentCourseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [StudentAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('courses', [StudentCourseController::class, 'index']);
    Route::post('logout', [StudentAuthController::class, 'logout']);
});
