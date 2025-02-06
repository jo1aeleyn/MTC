<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
=======
use App\Http\Controllers\ClientController;
>>>>>>> d82d1c34e4fbb82968e343f80cf294be4bdf0b12

Route::get('/', [AuthController::class, 'showLoginForm']);

Route::middleware('auth')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/employees/{uuid}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::patch('/employees/{uuid}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee/{uuid}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::patch('/employees/{uuid}/archive', [EmployeeController::class, 'archive'])->name('employee.archive');
});

Route::get('employees/export', [EmployeeController::class, 'export'])->name('employee.export');
 Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('employees/export', [EmployeeController::class, 'export'])->name('employee.export');
 Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Route
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfilePage'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::prefix('users')->middleware('auth')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{uuid}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{uuid}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{uuid}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});

// Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index'); // List all clients
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create'); // Show create form
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store'); // Store client
    Route::get('/{uuid}', [ClientController::class, 'show'])->name('clients.show'); // Show single client
    Route::get('/{uuid}/edit', [ClientController::class, 'edit'])->name('clients.edit'); // Show edit form
    Route::put('/{uuid}/update', [ClientController::class, 'update'])->name('clients.update'); // Update client
    Route::delete('/{uuid}/archive', [ClientController::class, 'archive'])->name('clients.archive'); // Archive client
});