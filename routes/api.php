<?php

use App\Http\Controllers\address_resolve;
use App\Http\Controllers\CustomerSignUp;
use App\Http\Controllers\DeliverySignUp;
use App\Http\Controllers\Login;
use App\Http\Controllers\ManagerSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewLaundry;
use App\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup',[SignUp::class,'store']);

Route::patch('/manager/signup/{email}',[ManagerSignUp::class,'update']);
Route::patch('/delivery/signup/{email}',[DeliverySignUp::class,'update']);
Route::patch('/customer/signup/{email}',[CustomerSignUp::class,'update']);
Route::post('/login',[Login::class,'store']);
Route::get('/manager/details/{laundry_id}',[ManagerSignUp::class,'show']);
Route::get('/customer/details/{email}',[CustomerSignUp::class,'show']);
Route::post('/customer/review',[ReviewLaundry::class,'store']);
Route::get('/manager/review/{manager_email}',[ReviewLaundry::class,'showAll']);
Route::get('/laundry',[ManagerSignUp::class,'showAll']);
Route::get('/services/{email}',[OrderController::class,'get_services']);
Route::post('/customer/get_reviews',[ReviewLaundry::class,'show']);
Route::post('/notifications/updateStatus', [NotificationController::class, 'updateStatus']);
Route::post('/address',[address_resolve::class,'show']);
Route::get('/notifications/latest/{email}', [NotificationController::class, 'showLatest']);
Route::get('/notifications/all/{email}', [NotificationController::class, 'showAll']);
Route::post('/notifications/updateStatus', [NotificationController::class, 'updateStatus']);
Route::get('/pricing/{email}', [OrderController::class, 'getPricing']);
Route::post('/pricing/addItem', [OrderController::class, 'addItem']);
Route::post('/pricing/updatePricing', [OrderController::class, 'updatePricing']);
Route::post('/order/addOrder', [OrderController::class, 'addOrder']);