<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class LandingController extends Controller
{
    public function createLanding() {
        return view('landing', [
            'airports' => $this->getAirports(),
            'tripTypes' => $this->getTripTypes()
        ]);
    }

    public function getAirports() {
        $airports = DB::table('airport')
            ->select('airport.city', 'airport.code', 'airport.id')
            ->orderBy('longitude', 'desc')
            ->get();

         return $airports;
    }

    public function getTripTypes() {
        $tripTypes = DB::table('trip_type')
            ->select('trip_type.id', 'trip_type.name')
            ->orderBy('id')
            ->get();

        return $tripTypes;
    }

    public function validateLandingForm(Request $request) {
        $request->validate([
            'departureAirport' => [
                'required',
                'string',
                Rule::notIn([$request->get('arrivalAirport')])
            ],
            'arrivalAirport' => [
                'required',
                'string',
                Rule::notIn([$request->get('departureAirport')])
            ],
            'tripType' => 'required'
        ]);

        $departureAirport = \App\Airport::where('id', $request->get('departureAirport'))->first();
        $arrivalAirport = \App\Airport::where('id', $request->get('arrivalAirport'))->first();
        $tripType = \App\TripType::where('id', $request->get('tripType'))->first();

        session([
            'departureAirport' => [
                'id' => $departureAirport->id,
                'city' => $departureAirport->city,
                'name' => $departureAirport->name,
            ],
            'arrivalAirport' => [
                'id' => $arrivalAirport->id,
                'city' => $arrivalAirport->city,
                'name' => $arrivalAirport->name,
            ],
            'tripType' => [
                'id' => $tripType->id,
                'name' => $tripType->name,
            ]
        ]);

        if ($request->input('tripType') == Config::get('constants.tripTypes.oneWay')) {
            return view('one-way');
        }
        else if ($request->input('tripType') == Config::get('constants.tripTypes.roundTrip')) {
            return view('round-trip');
        }
    }

}
