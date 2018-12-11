<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RideShare Api Endpoints</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    RideShare Api Endpoints
                </div>
                <ul style="list-style-type: none;">
                    <li>/api/clients</li>
                    <li>/api/drivers</li>
                    <li>/api/serviceable-requests</li>
                    <li>/api/history</li>
                    <li>/api/login?email=&password=</li>
                    <li>/api/register?first_name=&last_name=&email=&phone_number&password=&confirm_password=</li>
                    <li>/api/driver?id=</li>
                    <li>/api/client?id=</li>
                    <li>/api/client?id=</li>
                    <li>/api/client-requests?id=</li>
                    <li>/api/driver-requests?id=</li>
                </ul>
            </div>
        </div>
    </body>
</html>
