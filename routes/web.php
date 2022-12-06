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

Route::get('/dashboard',[ProfileController::class,'isuser'])->middleware(['auth', 'verified'])->name('dashboard');



// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/admin')->middleware('auth','isadmin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/users', [AdminController::class, 'user'])->name('users');
    Route::get('/addproduct', [AdminController::class, 'addproduct'])->name('addproduct');
    Route::post('/store', [AdminController::class, 'storeproduct'])->name('product.store');
    Route::post('/addcategory', [AdminController::class, 'categoryadd'])->name('category.add');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    // Route::post('/addproduct',[p])
   
});

Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/products', [UserController::class, 'products'])->name('showproduct');
    Route::get('/cart',[UserController::class,'cart'])->name('cart');
    Route::get('/order',[UserController::class,'order'])->name('order');
    Route::post('/add',[UserController::class,'addcart'])->name('cart.add');
    Route::get('/delete/{cartid}',[UserController::class,'delete'])->name('deletecart');
   
    Route::get('khalti/verify', [KhaltiController::class, 'verify'])->name('khalti.verify');
   
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
