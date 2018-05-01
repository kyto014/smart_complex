<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="{{ URL::asset('js/jquery.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/dataTables.min.js') }}" type="text/javascript" ></script>

        <link href="{{ URL::asset('css/dataTables.min.css') }}" rel="stylesheet"/>
        <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/additional_style.css') }}" rel="stylesheet">
        @yield('additional_headers')
        <title>Smart complex</title>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container navbarDiv">
                <a id="logo" class="logo" href="{{ url('/') }}" >SmartComplex</a>
                <ul class="options">
                    <li><a href="{{ url('/people') }}">ľudia</a></li>
                    <li><a href="{{ url('/profiles') }}">profily</a></li>
                    <li><a href="{{ url('/accesses') }}">prístupy</a></li>
                    <li><a href="{{ url('/keys') }}">kľúče</a></li>
                </ul>
            </div>
        </div>

        <div class="variable-content container">
            @yield('content')
        </div>

        <div class="footer">
            <div class="container">
                <p>&copy; MK</p>
            </div>
        </div>

    </body>
</html>
