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
                        <form method="POST" action="{{ config('app.url')}}/flight">
                            <h2> Select your city of departure</h2>
                            <div class="form-input">
                                <label>City</label> <input type="text" name="name">
                            </div>

                            <h2> Select your destination</h2>
                            <div class="form-input">
                                <label>City</label> <input type="text" name="name">
                            </div>

                            <button type="submit">Submit</button>
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>
