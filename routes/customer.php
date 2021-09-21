<?php 
use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;

// Auth Routes

Route::prefix('customer')->group(function () {
    Route::get('/login', [LoginController::class,'showCustomerLoginForm']);
    Route::get('/register', [RegisterController::class,'showCustomerRegisterForm']);

    Route::post('/login', [LoginController::class,'customerLogin']);
    Route::post('/register', [RegisterController::class,'createCustomer']);
});


Route::group(['middleware' => 'auth:customer','prefix'=>'customer'], function () {
    Route::view('/', ['url'=>'customer']);
    Route::post('/logout', [LoginController::class,'logout']);
});