<?php

use App\Http\Controllers\KosikController;
use App\Http\Controllers\ObchodController;
use App\Http\Controllers\ProduktyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Route;
use App\Models\Produkty;

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

Route::redirect('/', '/obchod');

Route::get('/obchod', function () {
    return view('obchod');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/obchod/add-to-cart/{product}', [KosikController::class, 'addToCart'])->name('cart.add');
    Route::get('/obchod/cart', [KosikController::class, 'index'])->name('cart.index');

    Route::post('/pay', [KosikController::class, 'pay'])->name('pay');


});
Route::get('/send-mail', [SendMailController::class, 'index']);

Route::get('/obchod', [ProduktyController::class, 'index'])->name('products.index');
Route::get('/obchod/create', [ProduktyController::class, 'create'])->name('products.create')->middleware('is_admin');
Route::post('/obchod', [ProduktyController::class, 'store'])->name('products.store')->middleware('is_admin');

Route::get('/obchod/{id}/edit', [ProduktyController::class, 'edit'])->name('products.edit')->middleware('is_admin');

Route::put('/obchod/{id}', [ProduktyController::class, 'update'])->name('products.update')->middleware('is_admin');;
Route::delete('/obchod/{id}', [ProduktyController::class, 'destroy'])->name('products.destroy')->middleware('is_admin');;


require __DIR__.'/auth.php';
