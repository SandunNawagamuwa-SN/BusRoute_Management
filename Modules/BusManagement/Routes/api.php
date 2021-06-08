<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:sanctum','admin']], function () {
    Route::resource('bus',BusManagementController::class)->only([
        'store','destroy','update','index'
    ])->middleware('admin');

    //Get all buses with there seats
    Route::get('/buseswithseats','BusManagementController@buseswithseats')->middleware('admin');

    //Get seats of particular bus
    Route::get('/seatsforbus/{id}','BusManagementController@seatforbus')->middleware('admin');

    //Get bus routes for bus
    Route::get('/busroutesforbus/{id}','BusManagementController@busrouteforbus')->middleware('admin');

    Route::resource('bus',BusManagementController::class)->only([
        'show'
    ]);
});

Route::middleware('auth:api')->get('/busmanagement', function (Request $request) {
    return $request->user();
});