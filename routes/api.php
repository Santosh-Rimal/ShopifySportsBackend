<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

// Route to fetch login user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
  
// Route to Register new user
Route::post('/registers',[ApiController::class,'registerIndex']);

// Route to post inquiries
Route::post('inquiries', [ApiController::class, 'indexInquiry']);

// Route to add/post product on cart
Route::post('carts', [ApiController::class, 'cart']);

// Route to Get all cart items of login user
Route::get('/single-user-cart/{userid}', [ApiController::class, 'singleUserCart']);


// Route to update cart
Route::put('/updatecart/{cartid}', [ApiController::class, 'updateCartItem']);

// Route to delete cart
Route::delete('/deletecarts/{cartid}', [ApiController::class, 'deleteCartItem']);

// Route to get all cart items of all users
Route::get('getCarts', [ApiController::class, 'getCart']);


// Route to get all categories
Route::get('categories', [ApiController::class, 'categoryIndex']);


// Route to get single category
Route::get('singlecategory/{id}',[ApiController::class,'categorysingle']);

// Route to get about us
Route::get('abouts', [ApiController::class, 'aboutIndex']);


// Route to post order of product
Route::post('order', [ApiController::class, 'order']);


// Route to get order of login user
Route::get('getOrder/{id}', [ApiController::class, 'getOrder']);


// Route to get all order or all user
Route::get('getOrder', [ApiController::class, 'getAllOrder']);


// Route to get rating and review of all product
Route::get('ratingReview', [ApiController::class, 'ratingReview']);


// Route to get rating and review of single product
Route::get('ratingReview/{id}', [ApiController::class, 'singleproductratingReview']);


// Route to post rating and review of product
Route::post('storeRatingReview', [ApiController::class, 'storeRatingReview']);


// Route to update order status after successful transaction
Route::put('updateOrderStatus/{invoice}', [ApiController::class, 'updateOrderStatus']);

// Route to get all product
Route::get('getproduct', [ApiController::class, 'productsIndex']);

// Route to get single product
Route::get('getsingleproduct/{id}', [ApiController::class, 'productSingle']);
// In routes/api.php or routes/web.php
// Route::delete('/cart/{id}', [ApiController::class, 'destroy']);

// Route for signup
Route::post('signup', [AuthController::class, 'signup']);

// Route for sigun
Route::post('signin', [AuthController::class, 'signin']);

// Route for logout
Route::post('signout', [AuthController::class, 'signout'])->middleware('auth:sanctum');


// Route to fetch all provinces
Route::get('/provinces', [ApiController::class, 'getProvinces']);

// Route to fetch all districts
Route::get('/districts', [ApiController::class, 'getDistricts']);

// Route to fetch districts by province name
Route::get('/districts/{province}', [ApiController::class, 'getDistrictsByProvince']);

// Route for recommandation
Route::get('/recommandation/{userid}',[ApiController::class,'getRecommendations']);