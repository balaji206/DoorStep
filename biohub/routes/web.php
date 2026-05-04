<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/links',[LinkController::class,'store'])->name('links.store');
    Route::put('/links/{id}',[LinkController::class,'update'])->name('links.update');
    Route::delete('/links/{id}',[LinkController::class,'destroy'])->name('links.destroy');
    Route::get('/links/create',[LinkController::class,'create'])->name('links.create');
    Route::get('/links/{id}/edit',[LinkController::class,'edit'])->name('links.edit');

});
require __DIR__.'/auth.php';
Route::get('/{username}', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->where('username', '[a-zA-Z0-9_-]+');

