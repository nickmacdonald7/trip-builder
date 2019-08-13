<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Flight extends Controller
{
    public function createFlight(Request $request) {
        $flights = DB::table('flight')
                        ->join('airline', 'flight.airline_id', '=', 'airline.id')
                        ->select('flight.number', 'airline.code')
                        ->get();

        foreach ($flights as $flight) {
            $request->session()->put('cities', $flight->code . $flight->number);
        }

        $airports = DB::table('airport')
            ->select('airport.city', 'airport.id')
            ->get();

        foreach ($airports as $airport) {
            $request->session()->put('airports', ['id' => $airport->id, 'city' => $airport->city]);
        }

        return view('trips');
    }
}
