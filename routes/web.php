<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KhaltiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/admin')->middleware('auth','isadmin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/users', [AdminController::class, 'user'])->name('users');
    Route::get('/addproduct', [AdminController::class, 'addproduct'])->name('addproduct');
    Route::post('/store', [AdminController::class, 'storeproduct'])->name('product.store');
    Route::get('/editproduct/{productid}', [AdminController::class, 'editproduct'])->name('editproduct');
    Route::post('/product/update/{product_id}',[AdminController::class,'updateproduct'])->name('product.update');
    Route::get('/deleteproduct/{productid}', [AdminController::class, 'deleteproduct'])->name('deleteproduct');
    Route::get('/deleteorder/{orderid}', [AdminController::class, 'deleteorder'])->name('deleteorder');
    Route::post('/addcategory', [AdminController::class, 'categoryadd'])->name('category.add');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/orders',[AdminController::class,'order'])->name('allorders');   
});

Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/products', [UserController::class, 'products'])->name('showproduct');
    Route::get('/cart',[UserController::class,'cart'])->name('cart');
    Route::get('/order',[UserController::class,'order'])->name('order');
    Route::post('/add',[UserController::class,'addcart'])->name('cart.add');
    Route::get('/delete/{cartid}',[UserController::class,'delete'])->name('deletecart');   
    Route::post('/khalti', [KhaltiController::class, 'verify'])->name('khalti.verify');
    Route::get('/successpage', [KhaltiController::class, 'successpage'])->name('successpage');

       
});
// Route::middleware('auth')->group(function(){
// Route::get('/done', [KhaltiController::class, 'sucess']);
//     Route::get('/done', [UserController::class, 'index']);
// });

Route::middleware('auth')->group(function () {
    Route::get('/done', [UserController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
