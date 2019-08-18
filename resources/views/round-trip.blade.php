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
                        <form method="POST" action="{{ route('form.roundTripDates') }}">
                            @csrf
                            <h2>Headed to {{ Session::get('arrivalAirport') }}? What date?</h2>
                            <div class="form-input">
                                <label>Departure Date</label>
                                <input type="text" class="date" name="departureDate">
                            </div>

                            <h2>And what date are you going back to {{ Session::get('departureAirport') }}?</h2>
                            <div class="form-input">
                                <label>Return Date</label>
                                <input type="text" class="date" name="returnDate">
                            </div>
                            <br>
                            <button type="submit">Select Flights</button>
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
    $(function () {
        $( ".date" ).datepicker({
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>
