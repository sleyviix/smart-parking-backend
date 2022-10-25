<?php





use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\UsersController;
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

    Route::get('userMe', [UsersController::class,'userMe']);
});


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
