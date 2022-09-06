<?php

use App\Http\Controllers\Api\ClientController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('clients')->group(function () {
    Route::get('/business-type',          [ClientController::class, 'getBusinessType']);
    Route::get('/king-of-people',         [ClientController::class, 'getKingOfPeople']);
    Route::get('/get-info-to-address',    [ClientController::class, 'getInfoToAddress']);
    // Route::post('/create',      [SaleController::class, 'create']);
    // Route::get('/{id}',         [SaleController::class, 'show']);
    // Route::put('/update/{id}',  [SaleController::class, 'update']);
    // Route::patch('/update',     [SaleController::class, 'updateSales']);
    // Route::delete('/{id}',      [SaleController::class, 'destroy']);
});
