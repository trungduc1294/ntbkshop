<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShipperController;
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

Route::get('/demo', function() {
    dd(123);
});

Route::get('/', [HomeController::class,'index']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class,'redirect']);



Route::get('/view_catagory', [AdminController::class,'view_catagory']);

Route::post('/add_catagory', [AdminController::class,'add_catagory']);

Route::get('/delete_catagory/{id}', [AdminController::class,'delete_catagory']);

Route::get('/view_product', [AdminController::class,'view_product']);

Route::post('/add_product', [AdminController::class,'add_product']);

Route::get('/show_product', [AdminController::class,'show_product']);

Route::get('/delete_product/{id}', [AdminController::class,'delete_product']);

Route::get('/update_product/{id}', [AdminController::class,'update_product']);

Route::post('/update_product_confirm/{id}', [AdminController::class,'update_product_confirm']);

Route::get('/order', [AdminController::class,'order']);

Route::get('/today_order', [AdminController::class,'today_order']);

Route::get('/delivered/{id}', [AdminController::class,'delivered']);

Route::get('/print_pdf/{id}', [AdminController::class,'print_pdf']);

Route::get('/send_email/{id}', [AdminController::class,'send_email']);

Route::post('/send_user_email/{id}', [AdminController::class,'send_user_email']);

Route::get('/search', [AdminController::class,'search_data']);

Route::get('/add_banner', [AdminController::class,'add_banner']);

Route::get('/qr_code', [AdminController::class,'qr_code']);

Route::post('/add_banner_sale', [AdminController::class,'add_banner_sale']);

Route::get('/delete_banner/{id}', [AdminController::class,'delete_banner']);

Route::get('/delete_banner_img/{id}', [AdminController::class,'delete_banner_img']);

Route::get('/delete_qrcode_img/{id}', [AdminController::class,'delete_qrcode_img']);

Route::get('/new_product_config', [AdminController::class,'new_product_config']);

Route::post('/new_product_config', [AdminController::class,'new_product_config_submit']);

Route::get('/delete_hot_product/{id}', [AdminController::class,'delete_hot_product']);

Route::post('/add_banner_img', [AdminController::class,'add_banner_img']);

Route::post('/add_qrcode_img', [AdminController::class,'add_qrcode_img']);

Route::get('/choose_banner_img/{id}', [AdminController::class,'choose_banner_img']);

Route::get('/choose_qrcode_img/{id}', [AdminController::class,'choose_qrcode_img']);

Route::get('/choose_hot_product/{id}', [AdminController::class,'choose_hot_product']);

Route::get('/add_shipper', [AdminController::class,'add_shipper']);

Route::get('/choose_shipper/{id}', [AdminController::class,'choose_shipper']);

Route::get('/search_user', [AdminController::class,'search_user']);

Route::post('/set_shipper', [AdminController::class,'set_shipper']);

Route::get('/add_admin', [AdminController::class,'add_admin']);

Route::get('/choose_admin/{id}', [AdminController::class,'choose_admin']);





Route::get('/product_details/{id}', [HomeController::class,'product_details']);

Route::post('/add_cart/{id}', [HomeController::class,'add_cart']);

Route::get('/show_cart', [HomeController::class,'show_cart']);

Route::get('/remove_cart/{id}', [HomeController::class,'remove_cart']);

Route::get('/cash_order', [HomeController::class,'cash_order']);

Route::get('/stripe/{totalPrice}', [HomeController::class,'stripe']);

Route::post('stripe/{totalPrice}', [HomeController::class,'stripePost'])->name('stripe.post');

Route::get('/show_order', [HomeController::class,'show_order']);

Route::get('/cancel_order/{id}', [HomeController::class,'cancel_order']);

Route::post('/add_comment', [HomeController::class,'add_comment']);

Route::post('/add_reply', [HomeController::class,'add_reply']);

Route::post('/product_search', [HomeController::class,'product_search']);

Route::get('/products', [HomeController::class,'products']);

Route::post('/search_product', [HomeController::class,'search_product']);

Route::get('/catagory_products/{id}', [HomeController::class,'category_products']);





Route::get('/done_order/{id}', [ShipperController::class,'done_order']);

