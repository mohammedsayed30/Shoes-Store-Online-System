<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Notifications\OrderNotification;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



/*************************************************************************
 *                                    User Identity Routes
 *************************************************************************/

//admin only routes
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/v1/admin/users',[UserController::class,'index']);
    Route::get('/v1/admin/users/{id}',[UserController::class,'show']);
    Route::put('/v1/admin/users/{id}',[UserController::class,'update']);
    Route::delete('/v1/admin/users/{id}',[UserController::class,'destroy']);  
});

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::post('v1/users/register', [UserController::class, 'register']);
    Route::post('v1/users/login', [UserController::class, 'login']);
});

// Authenticated-only routes
Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('v1/users/logout', [UserController::class, 'logout']);
    Route::get('v1/users/profile/account', [UserController::class, 'profileaccount']);
    Route::get('v1/users/profile/orders', [UserController::class, 'profileorders']);
});

/*************************************************************************
 *                                    categories Mangament Routes
 *************************************************************************/

//products routes that can only be accessed by admin users
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('v1/admin/categories', [CategoryController::class, 'store']);
    Route::put('v1/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('v1/admin/categories/{id}', [CategoryController::class, 'destroy']);
});

// Public routes
Route::get('v1/categories', [CategoryController::class, 'index']);
Route::get('v1/categories/{id}', [CategoryController::class, 'showById']) ->where('id', '[0-9]+');
Route::get('v1/categories/{name}', [CategoryController::class, 'show']);

/*************************************************************************
 *                                    Products Mangament Routes
 *************************************************************************/

//products routes that can only be accessed by admin users
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('v1/admin/products', [ProductController::class, 'store']);
    Route::put('v1/admin/products/{id}', [ProductController::class, 'update']);
    Route::delete('v1/admin/products/{id}', [ProductController::class, 'destroy']);
});

// Public routes
Route::get('v1/products', [ProductController::class, 'index']);
Route::get('v1/products/{id}', [ProductController::class, 'show']) ->where('id', '[0-9]+');
Route::get('v1/products/{name}', [ProductController::class, 'showByName']);

/*************************************************************************
 *                                    Stock  Routes
 *************************************************************************/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::put('v1/stock/update', [StockController::class, 'updateStock']);
    Route::delete('v1/stock/delete', [StockController::class, 'destroyStock']);
    Route::post('v1/stock/add', [StockController::class, 'storeStock']);
});

// get the stock of a product by (id and size and color) from the request
Route::get('v1/stock/get', [StockController::class, 'getStock']);


/*************************************************************************
 *                                    Shopping Cart Routes
 *************************************************************************/

// public Shopping cart routes

Route::post('v1/cart/add', [CartController::class, 'addToCart']);
Route::get('v1/cart/get', [CartController::class, 'getCart']);
Route::put('v1/cart/update', [CartController::class, 'updateCart']);
Route::delete('v1/cart/delete', [CartController::class, 'removeFromCart']);


//payment routes


Route::middleware(['auth:sanctum',])->group(function () {
    Route::post('v1/order/checkout', [PaymentController::class, 'processPayment']);
    //Route::post('v1/order/check', [OrderNotification::class, ' toMail']);
});









/**************************************************************************************
 *                                    Admin Panel Routes
 **************************************************************************************/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('v1/adminpanel', [AdminPanelController::class, 'adminpanel']);
});






































Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'API endpoint not found',
    ], 404);
});


