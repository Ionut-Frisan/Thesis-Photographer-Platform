<?php

use App\Http\Controllers\PhotoshootController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('photoshoots')->as('photoshoots.')->group(function () {
        Route::get('/', [PhotoshootController::class, 'index'])->name('index');
        Route::get('/create', [PhotoshootController::class, 'create'])->name('create');
        Route::post('/', [PhotoshootController::class, 'store'])->name('store');
        Route::get('/{photoshoot}', [PhotoshootController::class, 'show'])->name('show');
        Route::get('/{photoshoot}/edit', [PhotoshootController::class, 'edit'])->name('edit');
        // Route::put('/{photoshoot}', [PhotoshootController::class, 'update'])->name('update');
        // Route::delete('/{photoshoot}', [PhotoshootController::class, 'destroy'])->name('destroy');
    });
});
