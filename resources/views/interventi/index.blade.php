@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header prova">Lista Interventi</div>

                    <div class="card-body">
                        <a href="{{ route('interventi.create') }}" class="btn btn-primary mb-3">Aggiungi Intervento</a>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Descrizione Intervento</th>
                                <th>Ore Lavorate</th>
                                <th>Totale (€)</th>
                                <th>Stato</th>
                                <th>Fatturato</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($interventi as $intervento)
                                <tr>
                                    <td>{{ $intervento->cliente->nome }}</td>
                                    <td>{{ $intervento->descrizione }}</td>
                                    <td>{{ $intervento->ore_lavorate }}</td>
                                    <td>{{ $intervento->ore_lavorate * $intervento->prezzo_orario }}</td>
                                    <td>{{ $intervento->stato }}</td>
                                    <td>{{ $intervento->fatturato ? 'Sì' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('interventi.show', $intervento->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('interventi.edit', $intervento->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('interventi.pdf', $intervento->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i></a>
                                        <form action="{{ route('interventi.destroy', $intervento->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
