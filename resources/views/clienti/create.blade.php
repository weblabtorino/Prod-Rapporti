@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Aggiungi Cliente</h2>
        <form action="{{ route('clienti.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="prezzo_orario">Prezzo Orario (€)</label>
                <input type="number" step="0.01" class="form-control" id="prezzo_orario" name="prezzo_orario" value="{{ old('prezzo_orario', $cliente->prezzo_orario ?? '') }}">
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection
