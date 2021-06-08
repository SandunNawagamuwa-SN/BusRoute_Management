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

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('busroute',BusRouteManagementController::class)->only([
        'store','destroy','update','index'
    ])->middleware('admin');
    
    //Buses for particular route
    Route::get('/busesforbusroute/{id}','BusRouteManagementController@showbuses')->middleware('admin');
    
    //Schedules for particular route
    Route::get('/schedulesforbusroute/{id}','BusRouteManagementController@showschedules')->middleware('admin');

    //Routes for particular bus
    Route::get('/routesforbus/{id}','BusRouteManagementController@showroutes')->middleware('admin');
    
    Route::resource('busroute',BusRouteManagementController::class)->only([
        'show'
    ]);
});

Route::middleware('auth:api')->get('/busroutemanagement', function (Request $request) {
    return $request->user();
});