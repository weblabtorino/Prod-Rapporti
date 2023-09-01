@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crea Sotto-Intervento</h2>
        <form action="{{ route('sottoInterventi.store', ['intervento' => $intervento]) }}" method="post">
            @csrf

            <div class="form-group">
                <input type="hidden" value="{{ $intervento }}" name="intervento_id">
            </div>

            <div class="form-group">
                <label for="descrizione">Descrizione:</label>
                <textarea class="form-control" name="descrizione" id="descrizione" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" class="form-control" name="data" id="data" required>
            </div>

            <div class="form-group">
                <label for="ora_inizio">Ora Inizio:</label>
                <input type="time" class="form-control" name="ora_inizio" id="ora_inizio" required>
            </div>

            <div class="form-group">
                <label for="ora_fine">Ora Fine:</label>
                <input type="time" class="form-control" name="ora_fine" id="ora_fine" required>
            </div>

            <button type="submit" class="btn btn-primary">Crea Sotto-Intervento</button>
           
        </form>
    </div>
@endsection
