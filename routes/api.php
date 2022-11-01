<?php

use App\Http\Controllers\Api\BNRController;
use App\Http\Controllers\Api\BOCController;
use App\Http\Controllers\Api\ECBController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\NBPController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'admin'])->group(function() {
    Route::delete('/bnr/deleteDaily', [BNRController::class, 'deleteDailyRates']);
    Route::delete('/bnr/deleteAll', [BNRController::class, 'deleteAllRates']);

    Route::delete('/ecb/deleteDaily', [ECBController::class, 'deleteDailyRates']);
    Route::delete('/ecb/deleteAll', [ECBController::class, 'deleteAllRates']);

    Route::delete('/nbp/deleteDaily', [NBPController::class, 'deleteDailyRates']);
    Route::delete('/nbp/deleteAll', [NBPController::class, 'deleteAllRates']);

    Route::delete('/boc/deleteDaily', [BOCController::class, 'deleteDailyRates']);
    Route::delete('/boc/deleteAll', [BOCController::class, 'deleteAllRates']);

    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/allUsers', [UserController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/bnr', [BNRController::class, 'index']);
    Route::get('/ecb', [ECBController::class, 'index']);
    Route::get('/nbp', [NBPController::class, 'index']);

    Route::post('/logout', [LoginController::class, 'destroy']);
    Route::post('/subscription', [SubscriptionController::class, 'store']);
    Route::get('/subscriptions', [SubscriptionController::class, 'index']);
});

Route::post('/register', [RegistrationController::class, 'store']);

Route::resource('login', LoginController::class)->only(['index', 'store']);

