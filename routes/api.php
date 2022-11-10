<?php





use App\Http\Controllers\Api\AuthenticationController;
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
    Route::patch('reservations/{reservation}', [ReservationController::class, 'update']);
    Route::delete('reservations/{reservation}', [ReservationController::class, 'delete']);
});

Route::middleware(['internal'])->group(function(){

    Route::get('parkingPlace', [\App\Http\Controllers\Api\parkingPlaceController::class, 'index']);
    Route::get('parkingPlace/{parkingPlace}/spots', [\App\Http\Controllers\Api\parkingSpotController::class, 'index']);
});




//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
