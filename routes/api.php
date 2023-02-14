<?php





use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\parkingPlaceController;
use App\Http\Controllers\Api\parkingSpotController;
use App\Http\Controllers\Api\PayController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/auth/register', [AuthenticationController::class, 'register']);

Route::post('/auth/loginToken', [AuthenticationController::class, 'loginToken']);



Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('Users', [UserController::class, 'User']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/{reservation:uuid}', [ReservationController::class, 'show']);
    Route::patch('reservations/{reservation}', [ReservationController::class, 'update']);
    Route::delete('reservations/{reservation}', [ReservationController::class, 'delete']);
    Route::post('/calculate-payment',PayController::class);
    Route::get('checkout/{reservation}',[CheckoutController::class, 'show']);
});



Route::middleware(['internal'])->group(function(){

    Route::get('parkingPlace', [parkingPlaceController::class, 'index']);
    Route::get('parkingPlace/{parkingPlace}', [parkingPlaceController::class, 'show']);
    Route::get('parkingPlace/{parkingPlace}/spots', [parkingSpotController::class, 'index']);
    Route::get('parkingPlace/{parkingPlace}/parkingSpots',[parkingSpotController::class, 'show']);
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
