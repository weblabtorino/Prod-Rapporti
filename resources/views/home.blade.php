@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Accesso Rapido</div>
                    <div class="card-body">
                        <div class="accesso-rapido-section">
                            <h3>Accesso Rapido</h3>
                            <div class="accesso-rapido-buttons">
                                <a href="{{ route('clienti.create') }}" class="btn btn-primary">Aggiungi Nuovo
                                    Cliente</a>
                                <a href="{{ route('interventi.create') }}" class="btn btn-success">Programma
                                    Intervento</a>
                                <a href="{{ route('calendar.index') }}" class="btn btn-info">Visualizza Calendario</a>
                                <!-- Altri pulsanti di accesso rapido possono andare qui -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Numero di interventi effettuati ogni mese nell'ultimo anno</div>
                    <div class="card-body">
                        <canvas id="interventiChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Distribuzione degli interventi</div>
                    <div class="card-body">
                        <canvas id="clientiChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Riepilogo delle Attività</div>
                    <div class="card-body">
                        <p>Interventi nell'ultimo mese: {{ $interventiUltimoMese }}</p>
                        <p>Nuovi clienti nell'ultimo mese: {{ $nuoviClientiUltimoMese }}</p>
{{--                        <h5>Prossimi Interventi:</h5>--}}
{{--                        <ul>--}}
{{--                            @foreach($prossimiInterventi as $intervento)--}}
{{--                                <li>{{ $intervento->data_inizio }} - {{ $intervento->cliente->nome }} <a--}}
{{--                                        href="{{ route('interventi.show', $intervento->id) }}/?from=dashboard"--}}
{{--                                        class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></li></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Notifiche e Allerte</div>
                    <div class="card-body">
{{--                        <h5>Interventi pianificati per oggi:</h5>--}}
{{--                        <ul>--}}
{{--                            @foreach($interventiOggi as $intervento)--}}
{{--                                <li class="mt-1">{{ $intervento->cliente->nome }} <a--}}
{{--                                        href="{{ route('interventi.show', $intervento->id) }}/?from=dashboard"--}}
{{--                                        class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}

                        <h5>Interventi da fatturare:</h5>
                        <ul>
                            @foreach($interventiDaFatturare as $intervento)
                                <li class="mt-1">{{ $intervento->cliente->nome }} - {{ $intervento->data_inizio }} <a
                                        href="{{ route('interventi.show', $intervento->id) }}/?from=dashboard"
                                        class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('interventiChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',  // or 'line'
            options: {
                responsive: true,
            },
            data: {
                labels: @json($mesi),
                datasets: [{
                    label: 'Numero di interventi',
                    data: @json($interventiMensili),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('clientiChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($data),
                    backgroundColor: [
                        // Qui puoi inserire una serie di colori. Ad esempio:
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        // ... e così via per ogni cliente
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribuzione degli interventi per cliente'
                }
            }
        });
    </script>
@endsection

