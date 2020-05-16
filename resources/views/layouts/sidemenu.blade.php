<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href=" {{asset('css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href=" {{asset('css/sweetalert.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        @font-face {
            font-family: "WDB_Bangna-Regular";
            src: url('{{asset('fonts/WDB_Bangna.ttf')}}');
        }

        body {
            font-family: 'WDB_Bangna-Regular' !important;
        }

    </style>
    @yield('css')
</head>
<body>
    <div id="app">
        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="border-right navbar-laravel" id="sidebar-wrapper">
                <div class="sidebar-heading">Start Bootstrap </div>
                {{-- <aside class="main-sidebar"> --}}
                    <section class="sidebar">
                        <ul class="sidebar-menu">
                            {{renderMenuItems(getMenuItems())}}
                        </ul>
                    </section>
                {{-- </aside> --}}
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light border-bottom navbar-laravel">
                    <button class="btn " id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
                     <!-- Right Side Of Navbar -->
                     {{-- <ul class="navbar-nav ml-auto"> --}}
                    <ul class="nav justify-content-end ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link">{{ Auth::user()->name }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>

                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('page-header')
                        @if(Breadcrumbs::exists())
                            {!! Breadcrumbs::render() !!}
                        @endif
                    </section>
    
                    <!-- Main content -->
                    <section class="content">
                        @include('layouts.partials.messages')
                        @yield('content')
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
            </div>
            <!-- /#page-content-wrapper -->

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/jquery.js') }}" ></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('js/custom.js') }}" ></script>
    <script src="{{ asset('js/template-script.js') }}" ></script>
    <script src="{{ asset('js/backend-custom.js') }}" ></script>
    
    <!-- Menu Toggle Script -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        });
    </script>
    <script src="{{ asset('js/sweetalert.js') }}" ></script>
    <script src="{{ asset('js/plugins.js') }}" ></script>
    @yield('javascript')
</body>
</html>
