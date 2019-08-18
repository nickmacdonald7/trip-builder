<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FlightsController extends Controller
{
    public function validateTrip(Request $request) {
        $departureDate = Session::get('departureDate');
        $departureFlight = \App\Flight::where('id', $request->get('departureFlight'))->first();
        $departureAirport = \App\Airport::where('id', Session::get('departureAirport.id'))->first();

        $departureFlightDepartureDatetime = date('Y-m-d H:i:s', strtotime("{$departureDate} {$departureFlight->departure_time}"));
        $departureFlightArrivalDatetime = date('Y-m-d H:i:s', strtotime("{$departureDate} {$departureFlight->arrival_time}"));

        $currentDatetimeInDepartureTimezone = new DateTime("now", new DateTimeZone($departureAirport->timezone));
        $currentDatetimeInDepartureTimezone = $currentDatetimeInDepartureTimezone->format('Y-m-d H:i:s');

        if (strtotime($departureFlightDepartureDatetime) < strtotime($currentDatetimeInDepartureTimezone)) {
            Session::flash('error', "Departure flight is not valid, departure time $departureFlightDepartureDatetime is earlier than current time
             in departure city, $currentDatetimeInDepartureTimezone. Pick another flight.");
            return redirect()->back();
        }

        if ($request->has('returnFlight')) {
            $returnDate = Session::get('returnDate');
            $returnFlight = \App\Flight::where('id', $request->get('returnFlight'))->first();

            $returnFlightDepartureDatetime = date('Y-m-d H:i:s', strtotime("{$returnDate} {$returnFlight->departure_time}"));

            if (strtotime($departureFlightArrivalDatetime) > strtotime($returnFlightDepartureDatetime)) {
                Session::flash('error', "Return flight is not valid, return flight leaves at $returnFlightDepartureDatetime before
                 the departing flight's arrival time at $departureFlightArrivalDatetime. Pick another flight.");
                return redirect()->back();
            }

        }

//        return view('full-trip', [
//
//        ]);
    }

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
            ->select('airline.code', 'flight.id', 'flight.number', 'flight.departure_time', 'flight.arrival_time', 'da.code AS da_code', 'aa.code AS aa_code')
            ->where('flight.departure_airport_id', '=', $departureAirportId)
            ->where('flight.arrival_airport_id', '=', $arrivalAirportId)
            ->get();

        return $flights;
    }
}
