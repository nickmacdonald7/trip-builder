<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Trip Builder</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title m-b-md">
                    Trip Builder
                </div>
                <h1>Your trip from {{ Session::get('departureAirport.city') }} to {{ Session::get('arrivalAirport.city') }}:</h1>

                <h2>Departing {{ Session::get('departureAirport.city') }} from {{ Session::get('departureAirport.code') }}:</h2>
                <p>Flight: {{ Session::get('departureFlight.name') }} ({{ Session::get('departureFlight.airlineName') }})</p>
                <p>Departs {{ Session::get('departureAirport.code') }} at {{ Session::get('departureFlight.departureTime') }} local time ({{ Session::get('departureFlight.departureTimezone') }}).</p>
                <p>Arrives in {{ Session::get('arrivalAirport.code') }} at {{ Session::get('departureFlight.arrivalTime') }} local time ({{ Session::get('departureFlight.arrivalTimezone') }}).</p>

                @if ($includeReturn)
                    <h2>Returning from {{ Session::get('arrivalAirport.city') }} via {{ Session::get('arrivalAirport.code') }}:</h2>
                    <p>Flight: {{ Session::get('returnFlight.name') }} ({{ Session::get('returnFlight.airlineName') }})</p>
                    <p>Departs {{ Session::get('arrivalAirport.code') }} at {{ Session::get('returnFlight.departureTime') }} local time ({{ Session::get('returnFlight.departureTimezone') }}).</p>
                    <p>Arrives in {{ Session::get('departureAirport.code') }} at {{ Session::get('returnFlight.arrivalTime') }} local time ({{ Session::get('returnFlight.arrivalTimezone') }}).</p>

                @endif

                <h2>Total cost: ${{ number_format(Session::get('totalCost'), 2) }}</h2>
            </div>
        </div>
    </body>
</html>
