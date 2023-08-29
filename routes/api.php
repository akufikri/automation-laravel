<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getTaxi', [Api\ApiTaxiController::class, 'getTaxi']);
Route::post('storeTaxi', [Api\ApiTaxiController::class, 'storeTaxi']); 
Route::delete('deleteTaxi/{id}', [Api\ApiTaxiController::class, 'deleteTaxi']);
Route::get('showTaxi/{id}', [Api\ApiTaxiController::class, 'showTaxi']);
Route::post('updateTaxi/{id}', [Api\ApiTaxiController::class, 'updateTaxi']);

Route::get('getRiders', [Api\ApiRidersController::class, 'getRiders']);
Route::post('storeRiders', [Api\ApiRidersController::class, 'storeRiders']);
Route::delete('deleteRiders/{id}', [Api\ApiRidersController::class, 'deleteRiders']);
Route::put('updateRiders/{id}', [Api\ApiRidersController::class, 'updateRiders']);
Route::get('showRiders/{id}', [Api\ApiRidersController::class, 'showRiders']);
Route::post('updateRiders/{id}', [Api\ApiRidersController::class, 'updateRiders']);
// Relations Riders
Route::get('getDataUsers', [Api\ApiRidersController::class, 'getDataUsers']);
Route::get('getDataTaxi', [Api\ApiRidersController::class, 'getDataTaxi']);


Route::get('getCountry', [Api\ApiCountryController::class, 'getCountry']);
Route::post('storeCountry', [Api\ApiCountryController::class, 'storeCountry']);
Route::get('showCountry/{id}', [Api\ApiCountryController::class, 'showCountry']);
Route::delete('deleteCountry/{id}', [Api\ApiCountryController::class, 'deleteCountry']);
Route::post('/updateCountry/{id}', [Api\ApiCountryController::class, 'updateCountry']);

Route::get('getCity', [Api\ApiCityController::class, 'getCity']);
Route::post('storeCity', [Api\ApiCityController::class, 'storeCity']);
Route::get('showCity/{id}', [Api\ApiCityController::class, 'showCity']);
Route::delete('deleteCity/{id}', [Api\ApiCityController::class, 'deleteCity']);
Route::post('/updateCity/{id}', [Api\ApiCityController::class, 'updateCity']);

Route::get('getState', [Api\ApiStateController::class, 'getState']);
Route::post('storeState', [Api\ApiStateController::class, 'storeState']);
Route::get('showState/{id}', [Api\ApiStateController::class, 'showState']);
Route::delete('deleteState/{id}', [Api\ApiStateController::class, 'deleteState']);
Route::post('/updateState/{id}', [Api\ApiStateController::class, 'updateState']);

Route::get('getFencing', [Api\ApiFencingController::class, 'getFencing']);
Route::post('storeFencing', [Api\ApiFencingController::class, 'storeFencing']);
Route::delete('deleteFencing/{id}', [Api\ApiFencingController::class, 'deleteFencing']);
Route::get('showFencing/{id}', [Api\ApiFencingController::class, 'showFencing']);
// relation data
Route::get('getDataCountry', [Api\ApiFencingController::class, 'getDataCountry']);
Route::get('getDataCity', [Api\ApiFencingController::class, 'getDataCity']);
Route::get('getDataState', [Api\ApiFencingController::class, 'getDataState']);

Route::get('getPinMap', [Api\ApiPinMapController::class, 'getPinMap']);
Route::get('getDataCountry', [Api\ApiPinMapController::class, 'getDataCountry']);
Route::get('getDataCity', [Api\ApiPinMapController::class, 'getDataCity']);
Route::post('storePinMap', [Api\ApiPinMapController::class, 'storePinMap']);
Route::delete('deletePinMap/{id}', [Api\ApiPinMapController::class, 'deletePinMap']);
Route::get('showPinMap/{id}', [Api\ApiPinMapController::class, 'showPinMap']);
Route::post('updatePinMap/{id}', [Api\ApiPinMapController::class, 'updatePinMap']);

Route::post('/proces_login', [LoginController::class, 'proces_login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::get('getTransactions', [Api\ApiTransactionController::class, 'getTransactions']);
Route::delete('deleteTransaction/{id}', [Api\ApiTransactionController::class, 'deleteTransaction']);
Route::post('storeTransaction', [Api\ApiTransactionController::class, 'storeTransaction']);
// Taxi show
Route::get('showTaxi', [Api\ApiTransactionController::class, 'showTaxi']);