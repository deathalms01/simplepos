<!DOCTYPE html>
<html lang="en" dir="ltr" ng-app='customerOrdersApp'>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SimplePos') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="{{ asset('lib/angularjs/angular.min.js') }}"></script>
    <script src="{{ asset('/lib/angularjs/angular-animate.min.js') }}"></script>
    <script src="{{ asset('lib/customerOrder.js') }}"></script>
  </head>
  <body>

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="custom-nav">
                <center>
                <a href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
              </center>
            </div>
        </div>
    </nav>

    @yield('content')


  </body>
</html>
