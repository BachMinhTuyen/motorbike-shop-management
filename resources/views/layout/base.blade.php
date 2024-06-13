<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{asset('assets/css/bootstrap_v5_3_3.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('css')
</head>
<body>
    @include('blocks.header')
    
    <div class="container" style="min-height: 435px">
        @yield('content')
    </div>

    @include('blocks.footer')
    <script src="{{asset('assets/js/bootstrap_v5_3_3.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/jquery_v3_7_1.min.js')}}"></script>
    @yield('js')
</body>
</html>