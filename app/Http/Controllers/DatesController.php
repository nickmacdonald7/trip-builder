<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;

class DatesController extends Controller
{
    public function validateOneWayDateForm(Request $request) {
        $currentDate = date('Y-m-d');
        $yearFromNowDate = $currentDate . '+1 year';

        //Validate departure date
        $request->validate([
            'departureDate' => [
                'required',
                'date',
                'before:' . $yearFromNowDate,
                'after_or_equal:' . $currentDate,
            ],
        ]);

        session(['departureDate' => (string)$request->get('departureDate')]);

        return redirect()->route('flights');
    }

    public function validateRoundTripDatesForm(Request $request) {
        $currentDate = date('Y-m-d');
        $yearFromNowDate = $currentDate . '+1 year';

        //Validate both departure and return dates
        $request->validate([
            'departureDate' => [
                'required',
                'date',
                'before_or_equal:returnDate',
                'before:' . $yearFromNowDate,
                'after_or_equal:' . $currentDate,
            ],
            'returnDate' => [
                'required',
                'date',
                'after_or_equal:departureDate',
                'before:' . $yearFromNowDate,
                'after_or_equal:' . $currentDate,
            ],
        ]);

        session([
            'departureDate' => $request->get('departureDate'),
            'returnDate' => $request->get('returnDate')
        ]);

        return redirect()->route('flights');
    }
}
