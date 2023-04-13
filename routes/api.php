<?php





use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\parkingPlaceController;
use App\Http\Controllers\Api\parkingSpotController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\PayController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
//use App\Admin;

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

Route::post('/login', [AuthenticationController::class, 'loginToken'])->name('login');

Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);

Route::post('password/reset', [PasswordResetController::class, 'reset']);
//Route::middleware(['auth:sanctum', 'admin'])->group(function(){
//    Route::post('parkingPlace/create', [parkingPlaceController::class, 'store']);
//    Route::get('dashbaord/users', [DashboardController::class, 'users']);
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
//
//});

Route::middleware(['auth:sanctum', 'admin'])->group(function(){
    Route::post('parkingPlace/create', [parkingPlaceController::class, 'store']);
    Route::patch('/dashboard/parkingPlaces/update/{id}', [DashboardController::class, 'updateParkingPlace']);
    Route::get('dashbaord/users', [DashboardController::class, 'users']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/users', [DashboardController::class, 'getAllUsers'])->name('dashboard.users');
    Route::get('/parkingPlaces', [DashboardController::class, 'showParkingPlaces'])->name('dashboard.show-parking-places');
    Route::patch('/dashboard/users/{id}', [DashboardController::class, 'updateUser']);
    Route::delete('/dashboard/users/delete/{user}', [DashboardController::class, 'deleteUser']);
    Route::get('/dashboard/parkingplaces/all', [DashboardController::class, 'getAllParkingPlaces']);
    Route::post('/dashboard/parkingspots/add', [DashboardController::class, 'addParkingSpot']);
    Route::get('/dashboard/parkingPlaces/parkingSpots/show/{id}', [DashboardController::class, 'getSpotsByParkingPlace']);
    Route::delete('/dashboard/parkingPlaces/parkingSpots/delete/{id}', [DashboardController::class, 'deleteParkingSpot']);
    Route::get('/dashboard/reservations/all', [DashboardController::class, 'viewAllReservations']);
    Route::delete('/dashboard/reservation/delete/{id}', [DashboardController::class, 'deleteReservation']);
    Route::delete('/parkingPlace/delete/{user}', [parkingPlaceController::class, 'deleteParkingPlace']);
});
//Route::post('parkingPlace/create', [parkingPlaceController::class, 'store']);
//Route::patch('/dashboard/parkingPlaces/update/{id}', [DashboardController::class, 'updateParkingPlace']);
//Route::get('dashbaord/users', [DashboardController::class, 'users']);
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
//Route::get('/dashboard/users', [DashboardController::class, 'getAllUsers'])->name('dashboard.users');
//Route::get('/parkingPlaces', [DashboardController::class, 'showParkingPlaces'])->name('dashboard.show-parking-places');
//Route::patch('/dashboard/users/{id}', [DashboardController::class, 'updateUser']);
//Route::delete('/dashboard/users/delete/{user}', [DashboardController::class, 'deleteUser']);
//Route::get('/dashboard/parkingplaces/all', [DashboardController::class, 'getAllParkingPlaces']);
//Route::post('/dashboard/parkingspots/add', [DashboardController::class, 'addParkingSpot']);
//Route::get('/dashboard/parkingPlaces/parkingSpots/show/{id}', [DashboardController::class, 'getSpotsByParkingPlace']);
//Route::delete('/dashboard/parkingPlaces/parkingSpots/delete/{id}', [DashboardController::class, 'deleteParkingSpot']);
//Route::get('/dashboard/reservations/all', [DashboardController::class, 'viewAllReservations']);
//Route::delete('/dashboard/reservation/delete/{id}', [DashboardController::class, 'deleteReservation']);


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('Users', [UserController::class, 'User']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::get('reservations/{reservation:uuid}', [ReservationController::class, 'show']);
    Route::patch('reservations/{reservation}', [ReservationController::class, 'update']);
    Route::delete('reservations/{reservation}', [ReservationController::class, 'delete']);
    Route::post('/calculate-payment',PayController::class);
    Route::get('checkout/{reservation}',[CheckoutController::class, 'show']);
    Route::get('/user', [UserController::class, 'showUser']);
    Route::match(['put', 'patch'], '/user', [UserController::class, 'updateUser']);
    Route::get('/users/{userId}/paid_amount', [UserController::class, 'sumPaidAmount']);
    Route::get('/users/{userId}/reservations/count', [UserController::class, 'countReservations']);
});



Route::middleware(['internal'])->group(function(){

    Route::get('reservations/show', [ReservationController::class, 'show']);
    Route::get('parkingPlace', [parkingPlaceController::class, 'index']);
//    Route::post('parkingPlace/create', [parkingPlaceController::class, 'store']);
    Route::get('parkingPlace/{parkingPlace}', [parkingPlaceController::class, 'show']);
    Route::get('parkingPlace/{parkingPlace}/spots', [parkingSpotController::class, 'index']);
    Route::get('parkingPlace/{parkingPlace}/parkingSpots',[parkingSpotController::class, 'show']);
    Route::get('/parking-places/{parkingPlaceId}/prices/sum', [ParkingPlaceController::class, 'sumPrices']);
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
