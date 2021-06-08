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
    Route::resource('busseat',BusSeatManagementController::class)->only([
        'store','destroy','update'
    ])->middleware('admin');
    Route::resource('busseat',BusSeatManagementController::class)->only([
        'show'
    ]);
});

Route::middleware('auth:api')->get('/busseatmanagement', function (Request $request) {
    return $request->user();
});

/*Route::post('/busseat','BusSeatManagementController@store');
Route::get('/busseat/{id}','BusSeatManagementController@show');
Route::delete('/busseat/{id}','BusSeatManagementController@destroy');
Route::put('/busseat/{id}','BusSeatManagementController@update');*/