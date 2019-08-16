<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


class Dates extends Controller
{
    public function createChooseDates(Request $request) {
        $request->flash();

        $departureAirport = \App\Airport::where('id', $request->get('departureAirport'))->first()->city;
        $arrivalAirport = \App\Airport::where('id', $request->get('arrivalAirport'))->first()->city;

        if ($request->input('tripType') == Config::get('constants.tripTypes.oneWay')) {
            return view('one-way', [
                'arrivalAirport' => $arrivalAirport,
            ]);
        }
        else if ($request->input('tripType' == Config::get('constants.tripTypes.roundTrip'))) {
            return view('round-trip', [
                'departureAirport' => $departureAirport,
                'arrivalAirport' => $arrivalAirport,
            ]);
        }
    }

}
