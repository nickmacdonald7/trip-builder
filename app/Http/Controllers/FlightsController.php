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
            ->select('airline.id', 'flight.number', 'airline.code')
            ->get();

        return $flights;
    }
}
