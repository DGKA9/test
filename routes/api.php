<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductTypeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\WorkingHoursController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\BranchController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\BookingServiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\EvaluateController;
use App\Http\Controllers\Api\DetailProductController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('profile', [AuthController::class, 'profile']);
        

});

    Route::get('/product-types/{id}', [ProductTypeController::class, 'getById']);
    Route::get('/product-types', [ProductTypeController::class, 'getAll']);
    Route::post('/product-types', [ProductTypeController::class, 'create']);
    Route::put('/product-types/{id}', [ProductTypeController::class, 'update']);
    Route::delete('/product-types/{id}', [ProductTypeController::class, 'delete']);

    Route::get('/roles', [RoleController::class, 'getAll']);
    Route::get('/roles/{id}', [RoleController::class, 'getById']);
    Route::post('/roles', [RoleController::class, 'create']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'delete']);

    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/users/{id}', [UserController::class, 'getById']);
    Route::post('/users', [UserController::class, 'create']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);

    Route::get('/working-hours', [WorkingHoursController::class, 'getAll']);
    Route::get('/working-hours/{id}', [WorkingHoursController::class, 'getById']);
    Route::post('/working-hours', [WorkingHoursController::class, 'create']);
    Route::put('/working-hours/{id}', [WorkingHoursController::class, 'update']);
    Route::delete('/working-hours/{id}', [WorkingHoursController::class, 'delete']);

    Route::get('/suppliers', [SupplierController::class, 'getAll']);
    Route::get('/suppliers/{id}', [SupplierController::class, 'getById']);
    Route::post('/suppliers', [SupplierController::class, 'create']);
    Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{id}', [SupplierController::class, 'delete']);

    Route::get('/services', [ServiceController::class, 'getAll']);
    Route::get('/services/{id}', [ServiceController::class, 'getById']);
    Route::post('/services', [ServiceController::class, 'create']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'delete']);

    Route::get('/customers', [CustomerController::class, 'getAll']);
    Route::get('/customers/{id}', [CustomerController::class, 'getById']);
    Route::post('/customers', [CustomerController::class, 'create']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'delete']);

    Route::get('/bookings', [BookingController::class, 'getAll']);
    Route::get('/bookings/{id}', [BookingController::class, 'getById']);
    Route::post('/bookings', [BookingController::class, 'create']);
    Route::put('/bookings/{id}', [BookingController::class, 'update']);
    Route::delete('/bookings/{id}', [BookingController::class, 'delete']);
    
    Route::get('/products', [ProductController::class, 'getAll']);
    Route::get('/products/{id}', [ProductController::class, 'getById']);
    Route::post('/products', [ProductController::class, 'create']);
     Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);

    Route::get('/payments', [PaymentController::class, 'getAll']);
    Route::get('/payments/{id}', [PaymentController::class, 'getById']);
    Route::post('/payments', [PaymentController::class, 'create']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
    Route::delete('/payments/{id}', [PaymentController::class, 'delete']);

    Route::get('/orders', [OrderController::class, 'getAll']);
    Route::get('/orders/{id}', [OrderController::class, 'getById']);
    Route::post('/orders', [OrderController::class, 'create']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'delete']);

    Route::get('/evaluates', [EvaluateController::class, 'getAll']);
    Route::get('/evaluates/{id}', [EvaluateController::class, 'getById']);
    Route::post('/evaluates', [EvaluateController::class, 'create']);
    Route::put('/evaluates/{id}', [EvaluateController::class, 'update']);
    Route::delete('/evaluates/{id}', [EvaluateController::class, 'delete']);

    Route::get('/branches', [BranchController::class, 'getAll']);
    Route::get('/branches/{id}', [BranchController::class, 'getById']);
    Route::post('/branches', [BranchController::class, 'create']);
    Route::put('/branches/{id}', [BranchController::class, 'update']);
    Route::delete('/branches/{id}', [BranchController::class, 'delete']);

    Route::get('/employees', [EmployeeController::class, 'getAll']);
    Route::get('/employees/{id}', [EmployeeController::class, 'getById']);
    Route::post('/employees', [EmployeeController::class, 'create']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'delete']);

    Route::get('bookings-services', [BookingServiceController::class, 'getAll']);
    //Route::get('bookings-services', [BookingServiceController::class, 'getById']);
    Route::post('bookings-services', [BookingServiceController::class, 'create']);
    Route::put('bookings-services', [BookingServiceController::class, 'update']);
    Route::delete('bookings-services', [BookingServiceController::class, 'delete']);

    Route::get('detail-products', [DetailProductController::class, 'getAll']);
    Route::get('detail-products/{id}', [DetailProductController::class, 'getById']);
    Route::post('detail-products', [DetailProductController::class, 'create']);
    Route::put('detail-products/{id}', [DetailProductController::class, 'update']);
    Route::delete('detail-products', [DetailProductController::class, 'delete']);


    
