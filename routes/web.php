<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
Route::get('/confirm/{user}', [UserController::class, 'showConfirmForm'])->name('confirm');
Route::post('/', [UserController::class, 'loginOrRegister'])->name('login_submit');
Route::post('/confirm/{user}', [UserController::class, 'confirmAndLogin'])->name('confirm_submit');
