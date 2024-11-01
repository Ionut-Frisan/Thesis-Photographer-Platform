<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('images')->as('images.')->group(function () {
        Route::get('/', [ImageController::class, 'index'])->name('index');
        Route::post('/', [ImageController::class, 'store'])->name('store');
        Route::get('/{image}', [ImageController::class, 'show'])->name('show');
        Route::put('/{image}', [ImageController::class, 'update'])->name('update');
        Route::delete('/{image}', [ImageController::class, 'destroy'])->name('destroy');
        Route::get('/{image}/edit', [ImageController::class, 'edit'])->name('edit');
        Route::post('test/upload', [ImageController::class, 'upload'])->name('test.upload');
        Route::get('demo/upload', [ImageController::class, 'create'])->name('demo.upload');
    });
});
