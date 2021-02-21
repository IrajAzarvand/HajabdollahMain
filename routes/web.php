<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





//====================================== Dashboard Routes

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('Slider', SliderController::class);

Route::get('/Product/{ProductId}/{productImage}/delete',[ProductController::class,'ProductImgRemove'])->name('ProductImageRemove');
Route::resource('Product', ProductController::class);

Route::resource('History', HistoryController::class);

Route::resource('CeoMessage', CeoMessageController::class);

Route::resource('CH', CertificatesAndHonorsController::class);

Route::resource('OC', OrganizationalChartController::class);

Route::resource('Tags', TagController::class);

Route::resource('Category', CategoryController::class);

Route::resource('LatestNews', LatestNewsController::class);

Route::resource('Footer', FooterController::class);

Route::resource('PType', PTypeController::class);

Route::get('/Catalog/{ProductId}/{catalogImage}/delete',[ProductCatalogController::class,'ProductCatalogRemove'])->name('ProductCatalogRemove');
Route::resource('Catalog', ProductCatalogController::class);

Route::get('/Gallery/{GalleryId}/{GalleryImage}/delete',[GalleryController::class,'GalleryImgRemove'])->name('GalleryImageRemove');
Route::resource('Gallery', GalleryController::class);

Route::resource('SO', SalesOfficeController::class);

Route::resource('CI', CIController::class); //Company Introduction

Route::resource('CUMessages', MessageController::class);

//====================================== Dashboard Routes End
