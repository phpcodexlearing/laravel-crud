<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('productList', function () {
    return view('product');
})->name('product.list.view');



Route::get('productEdit/{id?}', [ProductController::class, 'productEdit'])->name('product.edit');
Route::get('productView/{id}', [ProductController::class, 'viewProudct'])->name('product.view');

Route::post('addEdit', [ProductController::class, 'addEdit'])->name('product.add.edit');
Route::post('productList', [ProductController::class, 'index'])->name('product.list');

Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('delete.product');
Route::post('fetch-categories', [ProductController::class, 'fetchCategories'])->name('fetch.category');
Route::post('fetch-subcategories', [ProductController::class, 'fetchSubcategories'])->name('fetch.subcategory');


