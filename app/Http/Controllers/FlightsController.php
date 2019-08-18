<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FlightsController extends Controller
{
    public function createFlights() {
        $departureFlights = [];
        $returnFlights = [];

        $departureFlights = $this->getFlights(Session::get('departureAirport.id'), Session::get('arrivalAirport.id'));

        if (Session::get('tripType.id') == Config::get('constants.tripTypes.roundTrip')) {
            $returnFlights = $this->getFlights(Session::get('arrivalAirport.id'), Session::get('departureAirport.id'));
        }

        return view('flights', [
            'departureFlights' => $departureFlights,
            'returnFlights' => $returnFlights,
        ]);
    }

    public function getFlights($departureAirportId, $arrivalAirportId) {
        $flights = DB::table('flight')
            ->join('airline', 'flight.airline_id', '=', 'airline.id')
            ->join('airport AS da', 'flight.departure_airport_id', '=', 'da.id')
            ->join('airport AS aa', 'flight.arrival_airport_id', '=', 'aa.id')
            ->select('airline.id', 'airline.code', 'flight.number', 'flight.departure_time', 'flight.arrival_time', 'da.code AS da_code', 'aa.code AS aa_code')
            ->where('flight.departure_airport_id', '=', $departureAirportId)
            ->where('flight.arrival_airport_id', '=', $arrivalAirportId)
            ->get();

        return $flights;
    }
}
