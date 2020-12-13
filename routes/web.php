<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {

	Route::middleware(['admin'])->group(function () {
		Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminindex'])->name('admin.home');

		Route::get('/add/brand', [App\Http\Controllers\AdminController::class, 'addbrand'])->name('add.brand');
		Route::post('/add/brand', [App\Http\Controllers\AdminController::class, 'storebrand'])->name('add.brand');
		Route::get('/all/brand', [App\Http\Controllers\AdminController::class, 'allbrand'])->name('all.brand');
		Route::get('/edit/brand/{id}', [App\Http\Controllers\AdminController::class, 'editbrand']);
		Route::post('/update/brand/{id}', [App\Http\Controllers\AdminController::class, 'updatebrand']);
		Route::get('/delete/brand/{id}', [App\Http\Controllers\AdminController::class, 'deletebrand']);

		Route::get('/add/category', [App\Http\Controllers\AdminController::class, 'addcategory'])->name('add.category');
		Route::post('/add/category', [App\Http\Controllers\AdminController::class, 'storecategory'])->name('add.category');
		Route::get('/all/category', [App\Http\Controllers\AdminController::class, 'allcategory'])->name('all.category');
		Route::get('/edit/category/{id}', [App\Http\Controllers\AdminController::class, 'editcategory']);
		Route::post('/update/category/{id}', [App\Http\Controllers\AdminController::class, 'updatecategory']);
		Route::get('/delete/category/{id}', [App\Http\Controllers\AdminController::class, 'deletecategory']);

		Route::get('/approve/seller', [App\Http\Controllers\AdminController::class, 'notapprovedseller'])->name('approve.seller');
		Route::get('/approve/seller/{id}', [App\Http\Controllers\AdminController::class, 'approveseller']);
		Route::get('/all/seller', [App\Http\Controllers\AdminController::class, 'allseller'])->name('all.seller');
		Route::get('/suspend/seller/{id}', [App\Http\Controllers\AdminController::class, 'suspendseller']);
	});

	Route::middleware(['seller'])->group(function () {
		Route::get('not/approved/seller/home', [App\Http\Controllers\HomeController::class, 'notapprovedsellerindex'])->name('not.approved.seller.home');

		Route::middleware(['approved'])->group(function () {
			Route::get('/seller/home', [App\Http\Controllers\HomeController::class, 'sellerindex'])->name('seller.home');

			Route::get('/add/shop', [App\Http\Controllers\SellerController::class, 'addshop'])->name('add.shop');
			Route::post('/add/shop', [App\Http\Controllers\SellerController::class, 'storeshop'])->name('add.shop');
			Route::get('/all/shop', [App\Http\Controllers\SellerController::class, 'allshop'])->name('all.shop');
			Route::get('/edit/shop/{id}', [App\Http\Controllers\SellerController::class, 'editshop']);
			Route::post('/update/shop/{id}', [App\Http\Controllers\SellerController::class, 'updateshop']);
			Route::get('/delete/shop/{id}', [App\Http\Controllers\SellerController::class, 'deleteshop']);

			Route::get('/add/product', [App\Http\Controllers\SellerController::class, 'addproduct'])->name('add.product');
			Route::post('/add/product', [App\Http\Controllers\SellerController::class, 'storeproduct'])->name('add.product');
			Route::get('/all/product', [App\Http\Controllers\SellerController::class, 'allproduct'])->name('all.product');
			Route::get('/edit/product/{id}', [App\Http\Controllers\SellerController::class, 'editproduct']);
			Route::post('/update/product/{id}', [App\Http\Controllers\SellerController::class, 'updateproduct']);
			Route::get('/delete/product/{id}', [App\Http\Controllers\SellerController::class, 'deleteproduct']);
		});
	});

	Route::middleware(['buyer'])->group(function () {
		Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('buyer.home');
	});
});
