<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'index']);
Route::get('/redirect', [HomeController::class,'redirect'])->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ไม่จำเป็นต้อง Login
Route::get('/product_details/{id}', [HomeController::class,'product_details']);

// จำเป็นต้อง Login เพื่อใช้งาน
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function (){

/********************************* Route For Admin **************************************************/
// Catagory
Route::get('/view_catagory', [AdminController::class,'view_catagory']);
Route::post('/add_catagory', [AdminController::class,'add_catagory']);
Route::get('/delete_catagory/{id}', [AdminController::class,'delete_catagory']);

// Product
Route::get('/view_product', [AdminController::class,'view_product']);
Route::post('/add_product', [AdminController::class,'add_product']);
Route::get('/show_product', [AdminController::class,'show_product']);
Route::get('/delete_product/{id}', [AdminController::class,'delete_product']);
Route::get('/update_product/{id}', [AdminController::class,'update_product']);
Route::post('/update_confirm_product/{id}', [AdminController::class,'update_confirm_product']);

// Order
Route::get('/order', [AdminController::class,'order']);
Route::get('/delivered/{id}', [AdminController::class,'delivered']);
Route::get('/print_pdf/{id}', [AdminController::class,'print_pdf']);
Route::get('/send_email/{id}', [AdminController::class,'send_email']);
Route::post('/send_user_email/{id}', [AdminController::class,'send_user_email']);
Route::get('/search', [AdminController::class,'searchdata']);

/*********************************  Route For Homepage **********************************************/
// Cart
Route::post('/add_cart/{id}', [HomeController::class,'add_cart']);
Route::get('/show_cart', [HomeController::class,'show_cart']);
Route::get('/remove_cart/{id}', [HomeController::class,'remove_cart']);

// Order
Route::get('/cash_order', [HomeController::class,'cash_order']);
Route::get('/show_order', [HomeController::class,'show_order']);
Route::get('/cancel_order/{id}', [HomeController::class,'cancel_order']);


// Stripe
Route::get('/stripe/{totalprice}', [HomeController::class,'stripe']);
Route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');

// Comment
Route::post('/add_comment', [HomeController::class,'add_comment']);
Route::post('/add_reply', [HomeController::class,'add_reply']);

});

