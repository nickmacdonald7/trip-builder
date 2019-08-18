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
                    <div class="form-group">
                        <form method="POST" action="{{ route('form.trip') }}">
                            @csrf
                            @if (count($departureFlights) > 0)
                                <h2>Choose a departing flight from {{ Session::get('departureAirport.city') }} on {{ date('F jS', strtotime(Session::get('departureDate'))) }}:</h2>
                                <div class="form-input">
                                    <label>City</label>
                                    <select class="form-control" id="departureFlight" name="departureFlight">
                                        @foreach ($departureFlights as $flight)
                                            <option
                                                id ="{{ $flight->id }}"
                                                {{ old('departureFlight') == $flight->id ? 'selected' : '' }}
                                                value="{{ $flight->id }}"
                                            >
                                                {{ $flight->code }}{{ $flight->number }} -
                                                {{ $flight->da_code }} to {{ $flight->aa_code }}
                                                (departing {{ date('H:i', strtotime($flight->departure_time)) }} - arriving {{ date('H:i', strtotime($flight->arrival_time)) }})
                                                - ${{ $flight->price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <p>No departing flights to display. Try choosing another city!</p>
                            @endif

                            @if (count($departureFlights) > 0 && count($returnFlights) > 0)
                                <h2>Choose a return flight from {{ Session::get('arrivalAirport.city') }} on {{ date('F jS', strtotime(Session::get('returnDate'))) }}</h2>
                                <div class="form-input">
                                    <label>City</label>
                                    <select class="form-control" id="returnFlight" name="returnFlight">
                                        @foreach ($returnFlights as $flight)
                                            <option
                                                id ="{{ $flight->id }}"
                                                {{ old('returnFlight') == $flight->id ? 'selected' : '' }}
                                                value="{{ $flight->id }}"
                                            >
                                                {{ $flight->code }}{{ $flight->number }} -
                                                {{ $flight->da_code }} to {{ $flight->aa_code }}
                                                (departing {{ date('H:i', strtotime($flight->departure_time)) }} - arriving {{ date('H:i', strtotime($flight->arrival_time)) }})
                                                - ${{ $flight->price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif (Session::get('tripType.id') == Config::get('constants.tripTypes.roundTrip'))
                                <p>No return flights to display. Try choosing another city!</p>
                            @endif
                            @if(Session::has('error'))
                                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                            @endif
                            @if (Session::get('tripType.id') == Config::get('constants.tripTypes.oneWay') && count($departureFlights) > 0)
                                <button type="submit">Show my one-way Trip</button>
                            @elseif (Session::get('tripType.id') == Config::get('constants.tripTypes.roundTrip') && count($departureFlights) > 0 && count($returnFlights) > 0)
                                <button type="submit">Show my round-trip Trip</button>
                            @else
                                <h2>Please go back and select another city to continue.</h2>
                            @endif
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>
