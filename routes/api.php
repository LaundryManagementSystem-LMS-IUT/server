<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\NotificationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup',[SignUp::class,'store']);

Route::post('/notifications/updateStatus', [NotificationController::class, 'updateStatus']);