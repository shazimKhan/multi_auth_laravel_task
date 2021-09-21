<?php 
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Customer\CustomerController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showAdminLoginForm']);
    Route::get('/register', [RegisterController::class,'showAdminRegisterForm']);

    Route::post('/login', [LoginController::class,'adminLogin']);
    Route::post('/register', [RegisterController::class,'createAdmin']);
});


Route::group(['middleware' => 'auth:admin','prefix'=>'admin'], function () {
    Route::view('/', ['url'=>'admin']);
    Route::post('logout', [LoginController::class,'logout']);
    Route::get('/customer-list', [CustomerController::class,'getCustomers'])->name('admin.customer.list');

    //Customer Resource
    Route::resource('customers', CustomerController::class,[
        'as'=>'admin'
    ]);
   
    
});
