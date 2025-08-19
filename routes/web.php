<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.data');
    Route::post('/store', [HomeController::class, 'store'])->name('fuel.store');
    Route::delete('/deletefuel/{id}', [HomeController::class, 'deleteFuel'])->name('fuel.delete');
    Route::get('/editload/{id}', [HomeController::class, 'editLoad'])->name('fuel.editload');
    Route::put('/editfuel/{id}', [HomeController::class, 'editFuel'])->name('fuel.edit');
    Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
