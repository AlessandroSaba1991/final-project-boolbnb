<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function ()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('apartments','ApartmentController');

    Route::get('apartments/{apartment}/messages','MessageController@index')->name('messages.index');
    Route::get('apartments/{apartment}/sponsorizations','SponsorizationController@index')->name('sponsorizations.index');
    Route::get('apartments/{apartment}/sponsorizations/{sponsorization}','SponsorizationController@show')->name('sponsorizations.show');
    Route::post('apartments/{apartment}/sponsorizations/{sponsorization}/checkout','SponsorizationController@checkout')->name('sponsorizations.checkout');



});






Route::get("{any?}", function ()
{
    return view("guest.home");
})->where("any",".*");
