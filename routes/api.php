<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\Settings\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Settings\DocumentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy bu  ilding your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',         [AuthController::class, 'logout']);
    Route::prefix('clients')->group(function () {
        Route::post('/save',                  [ClientController::class, 'save']);
        Route::get('/business-type',          [ClientController::class, 'getBusinessType']);
        Route::get('/king-of-people',         [ClientController::class, 'getKingOfPeople']);
        Route::get('/get-info-to-address',    [ClientController::class, 'getInfoToAddress']);
        Route::get('/get-info-from-dni',      [ClientController::class, 'getInfoFromDni']);
        Route::get('/get-info-ruc',           [ClientController::class, 'getInfoRuc']);
        // Route::post('/create',      [SaleController::class, 'create']);
        // Route::get('/{id}',         [SaleController::class, 'show']);
        // Route::put('/update/{id}',  [SaleController::class, 'update']);
        // Route::patch('/update',     [SaleController::class, 'updateSales']);
        // Route::delete('/{id}',      [SaleController::class, 'destroy']);
    });


    Route::prefix('settings')->group(function () {
        Route::prefix('profiles')->group(function () {
            Route::get('/',      [ProfileController::class, 'index']);
            Route::post('/{id}', [ProfileController::class, 'update']);
        });
        Route::prefix('documents')->group(function () {
            Route::get('/',         [DocumentController::class, 'index']);
            Route::get('/{id}',     [DocumentController::class, 'show']);
            Route::post('/',        [DocumentController::class, 'store']);
            Route::put('/{id}',     [DocumentController::class, 'update']);
            Route::delete('/{id}',  [DocumentController::class, 'destroy']);
        });
    });
});
