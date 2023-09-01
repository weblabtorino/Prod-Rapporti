@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista Clienti</h2>
        <a href="{{ route('clienti.create') }}" class="btn btn-primary mb-2">Aggiungi Cliente</a>
        <table class="table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clienti as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>
                        <a href="{{ route('clienti.edit', $cliente->id) }}" class="btn btn-warning">Modifica</a>
                        <form action="{{ route('clienti.destroy', $cliente->id) }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
