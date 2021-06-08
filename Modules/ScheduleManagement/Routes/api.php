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
    Route::resource('schedule',ScheduleManagementController::class)->only([
        'destroy','update','store'
    ])->middleware('admin');
    Route::resource('schedule',ScheduleManagementController::class)->only([
        'show','index'
    ]);
    //Get the route for a schedule
    Route::get('/routesforschedule/{id}','ScheduleManagementController@busroutesforschedule');
});

Route::middleware('auth:api')->get('/schedulemanagement', function (Request $request) {
    return $request->user();
});