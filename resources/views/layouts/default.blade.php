<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News API</title>
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>

  
</head>
    <body class="antialiased">
        @yield('content')


        <script type="text/javascript" src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>



    </body>
</html>