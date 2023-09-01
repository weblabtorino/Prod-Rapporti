<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestione Interventi')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS di Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- JavaScript di Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Link CSS personalizzato, se presente -->
{{--    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">Gestione Interventi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto"> <!-- Aggiunta di `mr-auto` per spingere i successivi contenuti a destra -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('interventi.index') }}">Interventi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('clienti.index') }}">Clienti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('calendar.index') }}">Calendario</a>
            </li>
            <!-- Altri link del menu possono essere aggiunti qui -->
        </ul>

        <!-- Menu a destra -->
        <ul class="navbar-nav">
            <li class="nav-item">
                @if(Auth::check())
                <span class="navbar-text mr-3">Benvenuto, {{ Auth::user()->name }}!</span>
                @endif

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

</nav>

<!-- Contenuto della Pagina -->
<div class="container-fluid mt-5">
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<!-- Footer -->
{{--<footer class="mt-5 p-3 text-center bg-dark footer">--}}
{{--    © 2023 Gestione Interventi - Tutti i diritti riservati.--}}
{{--</footer>--}}
</body>
<script src="{{ mix('js/app.js') }}" defer></script>
</html>
