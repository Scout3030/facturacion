<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link href="{{asset('assets/images/favicon.png')}}" rel="icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
<div id="main-wrapper">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

        <div class="app-main">

            <div class="app-main__outer">
                <div class="app-main__inner">


                    @yield('content')

                </div>
                @include('shared.footer')
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="https://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="{{asset('admin/assets/scripts/main.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
