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
            ->select('airline.id', 'airline.code', 'flight.number', 'flight.departure_time', 'flight.arrival_time')
            ->get();

        return $flights;
    }
}
