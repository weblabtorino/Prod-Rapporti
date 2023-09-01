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
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body>
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
</html>
