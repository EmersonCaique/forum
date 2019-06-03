<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div id="app">
        <nav class="flex bg-white shadow justify-between p-6">
            <div>
                <a href="{{ url('/home') }}" class="uppercase">Forum</a>
                <a href="{{ url('thread') }}" class="ml-5">All Threads</a>
            </div>

            @auth
            <div>
                <a href="{{ url('/thread?by='.auth()->user()->name) }}" class="ml-5">My Threads</a>
                <a href="{{ url('/thread/create') }}" class="ml-5">New Thread</a>
            </div>

            <div>
            <span>{{ auth()->user()->name }}</span>
            </div>

            @endauth

            @guest
            <div>
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="nav-link ml-4" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
            @endguest

        </nav>

        <main class="container py-4 mx-auto ">
            @yield('content')
        </main>
    </div>
</body>

</html>
