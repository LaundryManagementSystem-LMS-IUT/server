<?php


use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\customer;
use App\Models\notification;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    $users = User::all();
    return view('users', ['users' => $users]);
});

Route::get('/customers', function () {
    $customers = customer::all();
    return view('customers', ['customers' => $customers]);
});

Route::get('/notifications', function () {
    $notifications = notification::all();
    return view('notifications', ['notifications' => $notifications]);
});

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


Route::get('/notifications/latest/{email}', [NotificationController::class, 'showLatest']);
Route::get('/notifications/all/{email}', [NotificationController::class, 'showAll']);
Route::post('/notifications/updateStatus', [NotificationController::class, 'updateStatus']);


Route::get('/pricing/{email}', [OrderController::class, 'getPricing']);
