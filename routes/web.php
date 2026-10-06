<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('produtos', ProductController::class)->except('show');
    Route::resource('fornecedores', SupplierController::class)->except('show');
    Route::get('movimentacoes', [InventoryMovementController::class, 'index'])->name('movements.index');
    Route::get('movimentacoes/nova', [InventoryMovementController::class, 'create'])->name('movements.create');
    Route::post('movimentacoes', [InventoryMovementController::class, 'store'])->name('movements.store');
});
