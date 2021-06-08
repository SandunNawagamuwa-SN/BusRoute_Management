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
/*Route::get('/booking', function(){
    return 'rooo5';
});*/

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('booking',BookinManagementController::class)->only([
        'show','store','destroy','index'
        //index returns all bookings of particular user
    ]);
    //all bookings
    Route::get('/bookingall','BookinManagementController@allbooking');
});

Route::get('/book/{id}','BookinManagementController@book');

Route::middleware('auth:api')->get('/bookinmanagement', function (Request $request) {
    return $request->user();
});