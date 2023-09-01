<!DOCTYPE html>
<html>
<head>
    <title>Dettagli Intervento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .details {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Dettagli Intervento</h2>
    </div>

    <div class="details">
        <strong>Cliente:</strong> {{ $intervento->cliente->nome }}
    </div>

    <div class="details">
        <strong>Data Intervento:</strong> {{ $intervento->data_intervento }}
    </div>

    <div class="details">
        <strong>Descrizione:</strong> {{ $intervento->descrizione }}
    </div>

    <div class="details">
        <strong>Ore:</strong> {{ $intervento->ore_lavorate}}
    </div>

    <div class="details">
        <strong>Prezzo Orario:</strong> {{ $intervento->prezzo_orario }} €
    </div>

    <div class="details">
        <strong>Costo Totale:</strong> {{ $intervento->ore_lavorate * $intervento->prezzo_orario }} €
    </div>

</div>

</body>
</html>
