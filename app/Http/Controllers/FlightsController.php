<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightsController extends Controller
{
    public function createFlights() {
        return view('flights', [
            'flights' => $this->getFlights(),
            'departureAirport' => session()->get('departureAirport')
        ]);
    }

    public function getFlights() {
        $flights = DB::table('flight')
            ->join('airline', 'flight.airline_id', '=', 'airline.id')
            ->join('airport AS da', 'flight.departure_airport_id', '=', 'da.id')
            ->join('airport AS aa', 'flight.arrival_airport_id', '=', 'aa.id')
            ->select('airline.id', 'airline.code', 'flight.number', 'flight.departure_time', 'flight.arrival_time', 'da.code AS da_code', 'aa.code AS aa_code')
            ->get();

        return $flights;
    }
}
