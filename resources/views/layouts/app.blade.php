<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{asset('crm//assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    @notifyCss
    <link rel="stylesheet" type="text/css" href="{{asset('crm')}}/assets/libs/select2/dist/css/select2.min.css">

    <!-- Custom CSS -->
    <link href="{{asset('crm/dist/css/style.min.css')}}" rel="stylesheet">
    @stack('css')
</head>
<body>
@include('notify::messages')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.departments.index') }}">{{ __('main.departments') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.users.index') }}">{{ __('main.users') }}</a>
                        </li>
                            @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                            <!-- Authentication Links -->
                        @php $locale = session()->get('locale'); @endphp
                            <li class="nav-item dropdown">
                        @php $locale = session()->get('locale'); @endphp
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @switch($locale)
                                    @case('ru')
                                    <i class="flag-icon flag-icon-ru" title="ru" id="ru"></i> Русский
                                    @break

                                    @default
                                    <i class="flag-icon flag-icon-us" title="us" id="us"></i> English
                                @endswitch
                                <span class="caret"></span>
                            </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="lang/en"><i class="flag-icon flag-icon-us" title="us" id="us"></i> English</a>
                                    <a class="dropdown-item" href="lang/ru"><i class="flag-icon flag-icon-ru" title="us" id="ru"></i> Русский</a>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{asset('crm/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('crm/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('crm/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{asset('crm/dist/js/app.min.js')}}"></script>
    <script src="{{asset('crm/dist/js/app-style-switcher.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('crm/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('crm/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('crm/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->

    <script src="{{asset('crm/assets/libs/toastr/build/toastr.min.js')}}"></script>
    @notifyJs
    @stack('js')

</body>
</html>
