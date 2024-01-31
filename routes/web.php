<?php

use App\Http\Controllers\ObchodController;
use App\Http\Controllers\ProduktyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('obchod');
});

Route::get('/obchod', function () {
    return view('obchod');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/obchod', [ProduktyController::class, 'index'])->name('products.index');
Route::get('/obchod/create', [ProduktyController::class, 'create'])->name('products.create');
Route::post('/obchod', [ProduktyController::class, 'store'])->name('products.store');


require __DIR__.'/auth.php';
