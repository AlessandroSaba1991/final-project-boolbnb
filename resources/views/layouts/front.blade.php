<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BoolBNB7</title>

    <!-- Scripts -->
    <script src="{{ asset('js/front.js') }}" defer></script>
    <script src="{{ asset('js/mobile-or-tablet.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar backend navbar-light bg-white shadow-sm">
            <div class="container position-relative">

                <ul class="navbar-nav laravel_button d-flex flex-row">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entra') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end bg_orange" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.apartments.index') }}">{{ __('Dashboard') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>

            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
    @guest
    @else
    <script>
        window.user_email = "{{ Auth::user()->email }}"
        window.user_name = "{{ Auth::user()->name . ' ' . Auth::user()->surname }}"
    </script>
    @endguest
</body>

</html>
