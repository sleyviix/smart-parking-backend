<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\WebhookController;
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

Route::get('me', function () {
    return new \App\Http\Resources\parkingPlaceResourceCollection(\App\Models\parkingPlace::get());
});

Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
)->name('cashier.webhook');


//Route::post('login', [AuthenticationController::class, 'loginToken'])->name('login');;
