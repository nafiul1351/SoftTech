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

Route::get('/', [App\Http\Controllers\FrontendController::class, 'welcome'])->middleware('lscache:max-age=30;public');

Route::get('/search/result', [App\Http\Controllers\FrontendController::class, 'searchresult'])->name('search.result');

Route::get('/product/for/category/{id}', [App\Http\Controllers\FrontendController::class, 'categorywiseproduct']);

Route::get('/product/for/category/by/brand', [App\Http\Controllers\FrontendController::class, 'categorywisebrandproduct']);

Route::get('/product/for/brand/{id}', [App\Http\Controllers\FrontendController::class, 'brandwiseproduct']);

Route::get('/product/for/brand/by/category', [App\Http\Controllers\FrontendController::class, 'brandwisecategoryproduct']);

Route::get('/product/store', [App\Http\Controllers\FrontendController::class, 'productstore'])->name('product.store');

Route::get('/contact/us', [App\Http\Controllers\FrontendController::class, 'contactus'])->name('contact.us');

Route::get('/about/us', [App\Http\Controllers\FrontendController::class, 'aboutus'])->name('about.us');

Route::get('/product/detail/{id}', [App\Http\Controllers\FrontendController::class, 'productdetail']);

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {

	Route::middleware(['admin'])->group(function () {
		Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminindex'])->name('admin.home')->middleware('lscache:max-age=30;public');

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
		Route::get('not/approved/seller/home', [App\Http\Controllers\HomeController::class, 'notapprovedsellerindex'])->name('not.approved.seller.home')->middleware('lscache:max-age=30;public');

		Route::middleware(['approved'])->group(function () {
			Route::get('/seller/home', [App\Http\Controllers\HomeController::class, 'sellerindex'])->name('seller.home')->middleware('lscache:max-age=30;public');

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

			Route::get('/seller/processing/order', [App\Http\Controllers\SellerController::class, 'sellerprocessingorder'])->name('seller.processing.order');
			Route::get('/seller/completed/order', [App\Http\Controllers\SellerController::class, 'sellercompletedorder'])->name('seller.completed.order');
			Route::get('/seller/canceled/order', [App\Http\Controllers\SellerController::class, 'sellercanceledorder'])->name('seller.canceled.order');
			Route::get('/seller/view/order/{id}', [App\Http\Controllers\SellerController::class, 'sellervieworder']);
			Route::get('/package/order/{id}', [App\Http\Controllers\SellerController::class, 'packageorder']);
			Route::get('/ship/order/{id}', [App\Http\Controllers\SellerController::class, 'shiporder']);
			Route::get('/deliver/order/{id}', [App\Http\Controllers\SellerController::class, 'deliverorder']);
		});
	});

	Route::middleware(['buyer'])->group(function () {
		Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('buyer.home')->middleware('lscache:max-age=30;public');

		Route::get('/add/to/wishlist/{id}', [App\Http\Controllers\FrontendController::class, 'addtowishlist']);
		Route::get('/show/wishlist', [App\Http\Controllers\FrontendController::class, 'showwishlist'])->name('show.wishlist');
		Route::get('/remove/from/wishlist/{id}', [App\Http\Controllers\FrontendController::class, 'removefromwishlist']);

		Route::post('/add/to/cart/{id}', [App\Http\Controllers\FrontendController::class, 'addtocart']);
		Route::get('/remove/from/cart/{id}', [App\Http\Controllers\FrontendController::class, 'removefromcart']);
		Route::get('/view/cart', [App\Http\Controllers\FrontendController::class, 'viewcart'])->name('view.cart');
		Route::post('/update/cart/{id}', [App\Http\Controllers\FrontendController::class, 'updatecart']);

		Route::get('/order/checkout', [App\Http\Controllers\FrontendController::class, 'ordercheckout'])->name('order.checkout');
		Route::get('/add/order', [App\Http\Controllers\FrontendController::class, 'addorder'])->name('add.order');
		Route::get('/buyer/processing/order', [App\Http\Controllers\FrontendController::class, 'buyerprocessingorder'])->name('buyer.processing.order');
		Route::get('/buyer/completed/order', [App\Http\Controllers\FrontendController::class, 'buyercompletedorder'])->name('buyer.completed.order');
		Route::get('/buyer/canceled/order', [App\Http\Controllers\FrontendController::class, 'buyercanceledorder'])->name('buyer.canceled.order');
		Route::get('/buyer/view/order/{id}', [App\Http\Controllers\FrontendController::class, 'buyervieworder']);
		Route::get('/cancel/order/{id}', [App\Http\Controllers\FrontendController::class, 'cancelorder']);

		Route::post('/submit/review/{id}', [App\Http\Controllers\FrontendController::class, 'submitreview']);

		Route::post('/pay/order/{total}', [App\Http\Controllers\SslCommerzPaymentController::class, 'index']);
	});
});

Route::post('/payment/success', [App\Http\Controllers\SslCommerzPaymentController::class, 'success']);
Route::post('/payment/fail', [App\Http\Controllers\SslCommerzPaymentController::class, 'fail']);
Route::post('/payment/cancel', [App\Http\Controllers\SslCommerzPaymentController::class, 'cancel']);

Route::post('/payment/ipn', [App\Http\Controllers\SslCommerzPaymentController::class, 'ipn']);
