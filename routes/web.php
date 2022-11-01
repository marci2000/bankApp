<?php

use App\Http\Controllers\CurrencyFromController;
use App\Http\Controllers\CurrencyToController;
use App\Http\Controllers\DailyExchangeRatesController;
use App\Http\Controllers\ExchangeRateDatesController;
use App\Http\Controllers\ExchangeRatesByDate;
use App\Http\Controllers\ExchangeRatesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserSubscriptionController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['admin'])->group(function() {

    Route::get('users', [UserController::class, 'index']);

    Route::post('/activate', [BankController::class, 'update']);
});

Route::middleware(['auth'])->group(function() {

    Route::get('/banks', [BankController::class, 'index']);

    Route::get('/bank/{bank:id}', [ExchangeRatesController::class, 'show']);

    Route::get('/bank/{bank:id}/date', [ExchangeRatesByDate::class, 'show']);

    Route::resource('/subscribe', SubscriptionController::class)->only(['index', 'store']);

    Route::get('/subscriptions', [SubscriptionController::class, 'show']);
    Route::delete('/subscriptions/{subscription:id}', [SubscriptionController::class, 'destroy']);

    Route::get('/user/{user:id}', [UserSubscriptionController::class, 'show']);

    Route::get('/calculator', [CalculatorController::class, 'index']);
    Route::post('/calculate', [CalculatorController::class, 'store']);

    Route::get('/currency1', [CurrencyFromController::class, 'index']);
    Route::get('/currency2', [CurrencyToController::class, 'index']);
    Route::get('/dates', [ExchangeRateDatesController::class, 'index']);
});

Route::get('/', [DailyExchangeRatesController::class, 'index']);

