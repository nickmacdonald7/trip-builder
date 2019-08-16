<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getFlights() {
        $flights = DB::table('flight')
            ->join('airline', 'flight.airline_id', '=', 'airline.id')
            ->select('flight.number', 'airline.code')
            ->get();

        return $flights;
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
    }

}
