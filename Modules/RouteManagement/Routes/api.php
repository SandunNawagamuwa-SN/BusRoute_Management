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
    Route::resource('route',RouteManagementController::class)->only([
        'store','destroy','update','index'
    ])->middleware('admin');
    Route::resource('route',RouteManagementController::class)->only([
        'show'
    ]);
    //Get the busroutes for route
    Route::get('/busrouteforroute/{id}','RouteManagementController@busrouteforroutes');
});

Route::middleware('auth:api')->get('/routemanagement', function (Request $request) {
    return $request->user();
});