<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('apartments','API\ApartmentController@index');

Route::get('apartment/message','API\ApartmentController@saveMessage');

Route::get('apartments/sponsored','API\ApartmentController@sponsoredApartments');

Route::get('apartment/{apartment:id}','API\ApartmentController@show');

Route::get('services','API\ServiceController@index');

Route::get('visualization', 'API\VisualizationController@store');