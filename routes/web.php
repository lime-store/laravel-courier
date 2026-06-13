<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

// Главная страница — редирект на логин
Route::get('/', fn() => redirect()->route('login'));

// После логина — редирект по роли
Route::get('/redirect', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.index')
        : redirect()->route('courier.index');
})->middleware('auth')->name('redirect');

// Роуты для админа (только авторизованные с ролью admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',       [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
});

// Роуты для курьера (только авторизованные с ролью courier)
Route::middleware(['auth', 'role:courier'])->prefix('courier')->name('courier.')->group(function () {
    Route::get('/',                [OrderController::class, 'index'])->name('index');
    Route::post('/take/{order}',   [OrderController::class, 'take'])->name('take');
    Route::post('/status/{order}', [OrderController::class, 'updateStatus'])->name('status');
});

require __DIR__.'/auth.php';
