<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CepController;
use App\Http\Controllers\Api\AddressController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/cep/{cep}', [CepController::class, 'getCepData']);

Route::prefix('address')->group(function () {
    Route::get('/', [AddressController::class, 'index']);   // Lista todos os endereços
    Route::post('/', [AddressController::class, 'store']);  // Salva novo endereço
    Route::delete('/{id}', [AddressController::class, 'destroy']); // Exclui endereço
});