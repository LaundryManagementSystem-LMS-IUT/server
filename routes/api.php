<?php

use App\Http\Controllers\CustomerSignUp;
use App\Http\Controllers\DeliverySignUp;
use App\Http\Controllers\Login;
use App\Http\Controllers\ManagerSignUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\NotificationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup',[SignUp::class,'store']);

Route::patch('/manager/signup/{email}',[ManagerSignUp::class,'update']);
Route::patch('/delivery/signup/{email}',[DeliverySignUp::class,'update']);
Route::patch('/customer/signup/{email}',[CustomerSignUp::class,'update']);
Route::post('/login',[Login::class,'store']);
Route::post('/notifications/updateStatus', [NotificationController::class, 'updateStatus']);
