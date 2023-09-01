{{-- risorse/views/interventi/pdf.blade.php --}}

    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fattura</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>{{ $intervento['azienda']['nome'] }}</h1>
            <p>{{ $intervento['azienda']['indirizzo'] }}</p>
            <p>Codice Fiscale: {{ $intervento['azienda']['codice_fiscale'] }}</p>
            <p>Partita IVA: {{ $intervento['azienda']['partita_iva'] }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <img src="{{ $intervento['azienda']['logo'] }}" alt="Logo Azienda" class="img-responsive">
        </div>
        <div class="col-xs-6 text-right">
            <h3>Fattura n. {{ $intervento['id'] }}</h3>
            <p>Data: {{ $intervento['data'] }}</p>
            <h4>Dati Cliente</h4>
            <p>{{ $intervento['cliente']['nome'] }}</p>
            <p>{{ $intervento['cliente']['indirizzo'] }}</p>
            <p>{{ $intervento['cliente']['citta'] }}</p>
            <p>PIVA/Codice Fiscale: {{ $intervento['cliente']['piva'] }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h4>Condizioni di Pagamento</h4>
            <p>Bonifico Bancario</p>
            <p>IBAN: {{ $intervento['dati_banca']['iban'] }}</p>
            <!-- ... Altri dati bancari ... -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <!-- Intestazione e contenuti della tabella ... -->
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <p>Operazione effettuata ai sensi dell'art. 1, comma 587 e 59 della legge di stabilita 2015 (Legge 190/2014). E senza ritenuta d'acconto</p>
        </div>
    </div>

</div>

</body>
</html>
