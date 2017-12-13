<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
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
                font-size: 12px;
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
                    Instagram
                </div>
                <form action="{{ action('TweetController@tweetForm') }}" method="get">
                    {{ csrf_field() }}
                    Search:
                    <input type="text" name="search" value="" placeholder="Search..."><br>
                    <input type="submit">
                </form>
                <table>
                    <tr>
                        <th>Words</th>
                        <th>count</th>
                    </tr>
                    @foreach($tweets as $tweet=>$value)
                        <tr>
                            <td>{{$tweet}}</td>
                            <td>{{$value}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
