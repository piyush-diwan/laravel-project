<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\EmpController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'loginindex']);
Route::get('/register',[AuthController::class,'registerindex']);

Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');
Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Employee routes
    Route::prefix('employee')->group(function() {
        Route::get('/', [EmpController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmpController::class, 'create'])->name('employee.create');
        Route::post('/', [EmpController::class, 'store'])->name('employee.store');
        Route::get('/{id}', [EmpController::class, 'show'])->name('employee.show');
        Route::get('/edit/{id}', [EmpController::class, 'edit'])->name('employee.edit');
        Route::put('/{id}', [EmpController::class, 'update'])->name('employee.update');
        Route::delete('/{id}', [EmpController::class, 'destroy'])->name('employee.destroy');
    });

    Route::prefix('department')->group(function(){
        Route::get('/',[DeptController::class,'index'])->name('department.index');
        Route::get('/create',[DeptController::class,'create'])->name('department.create');
        Route::post('/',[DeptController::class,'store'])->name('department.store');
        Route::get('/edit/{id}',[DeptController::class,'edit'])->name('department.edit');
        Route::put('/{id}',[DeptController::class,'update'])->name('department.update');
        Route::delete('/{id}',[DeptController::class,'destroy'])->name('department.destroy');
    });
});