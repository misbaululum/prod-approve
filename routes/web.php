<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduksiController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::resource('users', UserController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ])->names(['index' => 'users', 'create' => 'users.create', 'edit' => 'users.edit']);

    Route::resource('produksi', ProduksiController::class);
    // Form untuk membuat atau mengedit produksi
    Route::get('/produksi/create', [ProduksiController::class, 'create'])->name('produksi.create');
    Route::post('/produksi', [ProduksiController::class, 'store'])->name('produksi.store');
    Route::put('/produksi/{produksi}', [ProduksiController::class, 'update'])->name('produksi.update');
    Route::get('/produksi/{id}/edit', [ProduksiController::class, 'edit'])->name('produksi.edit');
    Route::get('produksi/{produksi}', [ProduksiController::class, 'show'])->name('produksi.show');


    Route::middleware('auth')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
