<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('user/create', [UserController::class, 'create']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/update', [UserController::class, 'update']);
        Route::post('/archive', [UserController::class, 'archive']);
        Route::get('/get', [UserController::class, 'getByDetail']);
        Route::get('/get-all', [UserController::class, 'getAll']);
    });

    Route::prefix('social-media')->group(function () {
        Route::post('/create', [SocialMediaController::class, 'create']);
        Route::post('/update', [SocialMediaController::class, 'update']);
        Route::post('/delete', [SocialMediaController::class, 'delete']);
        Route::get('/get', [SocialMediaController::class, 'getByDetail']);
        Route::get('/get-all', [SocialMediaController::class, 'getAll']);
    });
    Route::prefix('contact')->group(function () {
        Route::post('/create', [ContactController::class, 'create']);
        Route::post('/update', [ContactController::class, 'update']);
        Route::post('/delete', [ContactController::class, 'delete']);
        Route::get('/get', [ContactController::class, 'getByDetail']);
        Route::get('/get-all', [ContactController::class, 'getAll']);
    });
    Route::prefix('jobs')->group(function () {
        Route::post('/create', [JobsController::class, 'create']);
        Route::post('/update', [JobsController::class, 'update']);
        Route::post('/delete', [JobsController::class, 'delete']);
        Route::get('/get', [JobsController::class, 'getByDetail']);
        Route::get('/get-all', [JobsController::class, 'getAll']);
    });
    Route::prefix('staff')->group(function () {
        Route::post('/create', [StaffController::class, 'create']);
        Route::post('/update', [StaffController::class, 'update']);
        Route::post('/delete', [StaffController::class, 'delete']);
        Route::get('/get', [StaffController::class, 'getByDetail']);
        Route::get('/get-all', [StaffController::class, 'getAll']);
    });
    Route::prefix('user-settings')->group(function () {
        Route::post('/update-profil', [UserSettingsController::class, 'updateProfil']);
        Route::post('/password-change', [UserSettingsController::class, 'passwordChange']);
    });

    Route::prefix('settings')->group(function () {
        Route::post('/create', [SettingsController::class, 'create']);
        Route::post('/update', [SettingsController::class, 'update']);
        Route::post('/delete', [SettingsController::class, 'delete']);
        Route::get('/get', [SettingsController::class, 'getByDetail']);
        Route::get('/get-all', [SettingsController::class, 'getAll']);
    });
});
