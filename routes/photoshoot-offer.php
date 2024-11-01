<?php


use App\Http\Controllers\PhotoshootOfferController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('photoshoot-offers')->as('photoshoot-offers.')->group(function () {
        Route::get('/', [PhotoshootOfferController::class, 'index'])->name('index');
        Route::get('/create', [PhotoshootOfferController::class, 'create'])->name('create');
        Route::post('/', [PhotoshootOfferController::class, 'store'])->name('store');
        Route::get('/{photoshootOffer}', [PhotoshootOfferController::class, 'show'])->name('show');
        Route::get('/{photoshootOffer}/edit', [PhotoshootOfferController::class, 'edit'])->name('edit');
        Route::put('/{photoshootOffer}', [PhotoshootOfferController::class, 'update'])->name('update');
        Route::delete('/{photoshootOffer}', [PhotoshootOfferController::class, 'destroy'])->name('destroy');
    });
});
