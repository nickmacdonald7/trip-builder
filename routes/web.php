<?php

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

Route::get('/', 'LandingController@createLanding');

Route::post('/', 'LandingController@validateLandingForm')->name('form.landing');

Route::get('/build-trip/one-way');
Route::get('/build-trip/round-trip');

Route::post('/build-trip/one-way', 'DatesController@validateOneWayDateForm')->name('form.oneWayDate');
Route::post('/build-trip/round-trip', 'DatesController@validateRoundTripDatesForm')->name('form.roundTripDates');

Route::get('/build-trip/flights', 'FlightsController@createFlights')->name('flights');
Route::post('/build-trip/flights', 'FlightsController@validateTrip')->name('form.trip');
