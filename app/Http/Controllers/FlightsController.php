<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\Rule;

class FlightsController extends Controller
{
    public function validateDatesForm(Request $request) {
        $request->validate([
            'departureDate' => [
                'required',
                'string',
                Rule::notIn([$request->get('arrivalAirport')])
            ],
            'arrivalDate' => [
                'required',
                'string',
                Rule::notIn([$request->get('departureAirport')])
            ],
            'tripType' => 'required'
        ]);

        $departureAirport = \App\Airport::where('id', $request->get('departureAirport'))->first()->city;
        $arrivalAirport = \App\Airport::where('id', $request->get('arrivalAirport'))->first()->city;

        if ($request->input('tripType') == Config::get('constants.tripTypes.oneWay')) {
            return view('one-way', [
                'arrivalAirport' => $arrivalAirport,
            ]);
        }
        else if ($request->input('tripType') == Config::get('constants.tripTypes.roundTrip')) {
            return view('round-trip', [
                'departureAirport' => $departureAirport,
                'arrivalAirport' => $arrivalAirport,
            ]);
        }
    }
}
