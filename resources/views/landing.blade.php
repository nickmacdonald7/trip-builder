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
                        <form method="POST" action="/builder/dates">
                            @csrf
                            <h2>Where are you taking off?</h2>
                            <div class="form-input">
                                <label>City</label>
                                <select class="form-control" id="departureAirport" name="departureAirport">
                                    @foreach ($airports as $airport)
                                        <option
                                            id ="{{ $airport->id }}"
                                            {{ old('departureAirport') == $airport->id ? 'selected' : '' }}
                                            value="{{ $airport->id }}"
                                        >
                                            {{ $airport->city }} - ({{ $airport->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <h2>Where are you headed?</h2>
                            <div class="form-input">
                                <label>City</label>
                                <select class="form-control" id="arrivalAirport" name="arrivalAirport">
                                    @foreach ($airports as $airport)
                                        <option
                                            id ="{{ $airport->id }}"
                                            {{ old('arrivalAirport') == $airport->id ? 'selected' : '' }}
                                            value="{{ $airport->id }}"
                                        >
                                            {{ $airport->city }} - ({{ $airport->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <h2>What kind of trip will this be?</h2>
                            <div class="form-input">
                                <label>Trip Type</label>
                                <select class="form-control" id="tripType" name="tripType">
                                    @foreach ($tripTypes as $tripType)
                                        <option
                                            id ="{{ $tripType->id }}"
                                            {{ old('tripType') == $tripType->id ? 'selected' : '' }}
                                            value="{{ $tripType->id }}"
                                        >
                                            {{ $tripType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <button type="submit">Start Building</button>
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>
