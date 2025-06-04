<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Requests\StoreProductRequest;
use App\Models\Season;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/register', [ProductController::class, 'showRegisterForm'])->name('products.register');
    Route::post('/register', [ProductController::class, 'register'])->name('products.store');

    
    Route::get('/{productId}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{productId}/update', [ProductController::class, 'update'])->name('products.update');

    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    
});
