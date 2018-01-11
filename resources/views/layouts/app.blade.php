<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link href="{{ asset('/css/app.css')}}" rel="stylesheet">
        <link href="{{ asset('/css/selectize.css')}}" rel="stylesheet">
        <link href="{{ asset('/css/selectize.bootstrap3.css')}}" rel="stylesheet">
        <link href="{{ asset('/css/navbar-fixed-top.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script>
        window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        ]); ?>
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Data <span class="caret"></span>
                                </a>
                                @role('admin')
                                @php
                                $array = [
                                'Guru', 'Kelas', 'Mapel', 'Siswa'
                                ];
                                collect($array);
                                @endphp
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        @foreach ($array as $arr)
                                        <li><a href="{{ url('/'.strtolower($arr)) }}">{{ $arr }}</a></li>
                                        @endforeach
                                    </li>
                                </ul>
                                @endrole
                                @role('guru')
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <li><a href="{{ url('/absen') }}">Absen</a></li>
                                        <li><a href="{{ url('/nilai') }}">Nilai</a></li>
                                    </li>
                                </ul>
                                @endrole
                            </li>
                            @endif
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    @php
                                    if (Auth::user()->hasRole('guru')) {
                                    foreach (Auth::user()->guru()->get() as $value) {
                                    echo $value->nama;
                                    }
                                    } else {
                                    echo Auth::user()->username;
                                    }
                                    @endphp
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            @if (Session::has('success'))
            <div class="container">
                <div class="alert alert-success">
                    <b>Sukses!</b> {{ Session::get('success') }}
                </div>
            </div>
            @endif
            @if (Session::has('fail'))
            <div class="container">
                <div class="alert alert-danger">
                    <b>Error!</b> {{ Session::get('fail') }}
                </div>
            </div>
            @endif
            @stack('error')
            @yield('content')
        </div>
        <!-- Scripts -->
        <script src="{{ asset('/js/app.js')}}"></script>
        <script src="{{ asset('/js/selectize.min.js')}}"></script>
        @stack('scripts')
    </body>
</html>