@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>Dettagli Intervento</h1>
                <hr>
                <dl>
                    <dt class="col-sm-3">Nome Cliente</dt>
                    <dd class="col-sm-9">{{ $intervento->cliente->nome }}</dd>

                    <dt class="col-sm-3">Descrizione</dt>
                    <dd class="col-sm-9">{{ $intervento->descrizione }}</dd>

                    <dt class="col-sm-3">Data Inizio</dt>
                    <dd class="col-sm-9">{{$intervento->data_inizio}}</dd>

                    <dt class="col-sm-3">Data Fine</dt>
                    <dd class="col-sm-9">{{ $intervento->data_fine}}</dd>

                    <dt class="col-sm-3">Ore Lavorate</dt>
                    <dd class="col-sm-9">{{ $intervento->ore_lavorate }}</dd>

                    <dt class="col-sm-3">Prezzo Orario</dt>
                    <dd class="col-sm-9">{{ $intervento->prezzo_orario }} €</dd>

                    <dt class="col-sm-3">Totale</dt>
                    <dd class="col-sm-9">{{ $intervento->ore_lavorate * $intervento->prezzo_orario }} €</dd>

                    <dt class="col-sm-3">Stato</dt>
                    <dd class="col-sm-9">{{ $intervento->stato }}</dd>
                </dl>
            </div>
        </div>

        @if(request()->get('from') === 'dashboard')
            <a href="/home" class="btn btn-primary">Torna alla Dashboard</a>
        @elseif(request()->get('from') === 'calendar')
            <a href="{{ route('calendar.index') }}" class="btn btn-primary">Torna al calendario</a>
        @else
            <a href="{{ route('interventi.index') }}" class="btn btn-primary">Torna alla lista degli interventi</a>
        @endif

    </div>
@endsection
