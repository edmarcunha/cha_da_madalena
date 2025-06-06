<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('admin');
})->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/', [PresentController::class, 'index']); // Página principal
Route::post('/select', [PresentController::class, 'select']); // Escolher presente

Route::middleware('auth')->group(function () {
    Route::get('/admin', [PresentController::class, 'admin'])->name('admin'); // Página de administração
    Route::post('/admin/add', [PresentController::class, 'store']); // Adicionar presente
    Route::delete('/admin/delete/{id}', [PresentController::class, 'delete'])->name('presents.delete');
    Route::patch('/admin/remove-donor/{id}', [PresentController::class, 'removeDonor'])->name('presents.removeDonor');
});

require __DIR__.'/auth.php';
