<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CUController;
use App\Http\Controllers\MainNavController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PTypeController;
use App\Http\Controllers\SalesOfficeController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', [MainNavController::class,'HomePage']);
Route::get('/locale/{lang}', [MainNavController::class,'locale']);





//====================================== Dashboard Routes

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('Slider', SliderController::class);

Route::get('/Product/{ProductId}/{productImage}/delete',[ProductController::class,'ProductImgRemove'])->name('ProductImageRemove');
Route::resource('Product', ProductController::class);

Route::resource('Category', CategoryController::class);

Route::resource('LatestNews', LatestNewsController::class);

Route::resource('PType', PTypeController::class);

Route::get('/Catalog/{ProductId}/{catalogImage}/delete',[ProductCatalogController::class,'ProductCatalogRemove'])->name('ProductCatalogRemove');
Route::resource('Catalog', ProductCatalogController::class);

Route::get('/Gallery/{GalleryId}/{GalleryImage}/delete',[GalleryController::class,'GalleryImgRemove'])->name('GalleryImageRemove');
Route::resource('Gallery', GalleryController::class);

Route::resource('SO', SalesOfficeController::class);

Route::resource('AboutUs', AboutUsController::class);

Route::resource('CUMessages', MessageController::class);

Route::resource('CU', CUController::class);

Route::resource('Address', AddressController::class);

//====================================== Dashboard Routes End
