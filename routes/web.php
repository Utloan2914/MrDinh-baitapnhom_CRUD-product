<?php

use App\Http\Controllers\apiProduct;
use Illuminate\Support\Facades\Route;


//Run for data json 
Route::post('/add-product', [apiProduct::class, 'store'])->name('addProduct');
Route::get('/products', [apiProduct::class, 'getProducts']);
Route::get('/detail/{id}', [apiProduct::class, 'detail']);
Route::delete('/delete/{id}', [apiProduct::class, 'delete']);
Route::put('/update/{id}', [apiProduct::class, 'update'])->name('updateProduct');

//Run the interface
Route::get('/', function () {
    return view('pageadmin.admin');
});
Route::get('/product/update/{id}', function ($id) {
    $product = App\Models\Product::find($id);
    return view('pageadmin.formEdit', compact('product'));
});
Route::get('/add-product', function () {
    return view('pageadmin.formAdd');
})->name('add-product');
