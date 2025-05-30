<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DashboardGroupController;


Route::get('/login', [GoogleAuthController::class, 'login'])->name('login');
Route::get('/login/auth', [GoogleAuthController::class, 'googleAuth'])->name('google.auth');
Route::get('/process/login', [GoogleAuthController::class, 'processLogin'])->name('process.login');
Route::get('/logout', [GoogleAuthController::class, 'logout']) -> name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/user', [UserController::class, 'user'])->name('user');
    Route::put('/user/approve/{id}', [UserController::class, 'approveUser'])->name('user.approve');
    Route::put('/user/unapprove/{id}', [UserController::class, 'unapproveUser'])->name('user.unapprove');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::put('/dashboard/{id}', [DashboardController::class, 'disableEnable'])->name('dashboard.disable_enable');
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');


    Route::get('/group/create', [DashboardGroupController::class, 'create'])->name('group.create');
    Route::post('/group/store', [DashboardGroupController::class, 'store'])->name('group.store');
    Route::get('/group/{id}/edit', [DashboardGroupController::class, 'edit'])->name('group.edit');
    Route::put('/group/{id}', [DashboardGroupController::class, 'update'])->name('group.update');
    Route::delete('/group/{id}', [DashboardGroupController::class, 'destroy'])->name('group.destroy');
});

