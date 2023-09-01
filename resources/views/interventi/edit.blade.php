@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifica Intervento</div>

                    <div class="card-body">
                        <form action="{{ route('interventi.update', $intervento->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id" required>
                                            @foreach($clienti as $cliente)
                                                <option value="{{ $cliente->id }}"
                                                        data-prezzo-orario="{{ $cliente->prezzo_orario }}"
                                                        {{ old('cliente_id', $intervento->cliente_id ?? null) == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" id="interventoId" value="{{ $intervento->id }}">

                                    <div class="form-group">
                                        <label for="descrizione">Descrizione Intervento</label>
                                        <textarea class="form-control" name="descrizione" id="descrizione" rows="3"
                                                  required>{{ $intervento->descrizione }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ore_lavorate">Ore Lavorate/previste</label>
                                        <input type="number" class="form-control" name="ore_lavorate" id="ore_lavorate"
                                               step="0.1" required value="{{ $intervento->ore_lavorate }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="data_inizio">Data Inizio:</label>
                                        <input type="date" name="data_inizio" class="form-control"
                                               value="{{ old('data_inizio', $intervento->data_inizio ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="data_fine">Data Fine:</label>
                                        <input type="date" name="data_fine" class="form-control"
                                               value="{{ old('data_fine', $intervento->data_fine ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="stato">Stato:</label>
                                        <select name="stato" class="form-control">
                                            <option
                                                    value="programmato" {{ old('stato', $intervento->stato ?? '') == 'programmato' ? 'selected' : '' }}>
                                                Programmato
                                            </option>
                                            <option
                                                    value="in_corso" {{ old('stato', $intervento->stato ?? '') == 'in_corso' ? 'selected' : '' }}>
                                                In Corso
                                            </option>
                                            <option
                                                    value="completato" {{ old('stato', $intervento->stato ?? '') == 'completato' ? 'selected' : '' }}>
                                                Completato
                                            </option>
                                            <option
                                                    value="cancellato" {{ old('stato', $intervento->stato ?? '') == 'cancellato' ? 'selected' : '' }}>
                                                Cancellato
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fatturato">Fatturato:</label>

                                        <!-- Campo nascosto con valore 0 -->
                                        <input type="hidden" name="fatturato" value="0">
                                        <!-- Checkbox con valore 1 -->
                                        <input type="checkbox" name="fatturato" id="fatturato" value="1"
                                                {{ old('fatturato', $intervento->fatturato ?? 0) == 1 ? 'checked' : '' }}>
                                    </div>


                                    <div class="form-group">
                                        <label>Prezzo Orario:</label>
                                        <span id="prezzoOrarioDisplay">0 €</span>
                                        <input type="hidden" name="prezzo_orario" id="prezzoOrarioInput" value="0">
                                    </div>

                                    <script>
                                        const clienteDropdown = document.getElementById('cliente_id');
                                        const prezzoOrarioDisplay = document.getElementById('prezzoOrarioDisplay');

                                        clienteDropdown.addEventListener('change', (event) => {
                                            const selectedOption = event.target.selectedOptions[0];
                                            const prezzoOrario = selectedOption.getAttribute('data-prezzo-orario');
                                            prezzoOrarioDisplay.textContent = `${prezzoOrario} €`;
                                            document.getElementById('prezzoOrarioInput').value = `${prezzoOrario}`;
                                        });

                                        // Trigger l'evento 'change' inizialmente per mostrare il prezzo orario del cliente selezionato al caricamento della pagina
                                        clienteDropdown.dispatchEvent(new Event('change'));
                                    </script>
                                </div>
                                <!-- Seconda Colonna: Costi Aggiuntivi -->
                                <div class="col-md-6">
                                    <h4>Costi Aggiuntivi</h4>
                                    <button type="button" class="btn btn-primary mb-2 aggCosti">
                                        Aggiungi Costo
                                    </button>
                                    <table class="table" id="costiTable">
                                        <thead>
                                        <tr>
                                            <th>Nome del Costo</th>
                                            <th>Valore (€)</th>
                                            <th>Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($interventoCosti->costiAggiuntivi as $costo)
                                            <tr data-costo-id="{{ $costo->id }}">
                                                <td>{{ $costo->descrizione }}</td>
                                                <td>{{ $costo->importo }} €</td>
                                                <td>
                                                    <button class="btn btn-success btn-sm editCostRow"
                                                            data-id="{{ $costo->id }}">Modifica
                                                    </button>
                                                    <button class="btn btn-danger btn-sm removeCostRow"
                                                            data-id="{{ $costo->id }}">Elimina
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Aggiorna Intervento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modale per l'inserimento dei costi -->
    <div class="modal fade" id="costiModal" tabindex="-1" role="dialog" aria-labelledby="costiModalLabel"
         aria-hidden="true">
        <input type="hidden" id="currentCostId" value="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="costModalLabel">Aggiungi Costo Aggiuntivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="descrizioneCosto" class="form-label">Descrizione</label>
                        <input type="text" class="form-control" id="descrizioneCosto">
                    </div>
                    <div class="mb-3">
                        <label for="importoCosto" class="form-label">Importo (€)</label>
                        <input type="number" step="0.01" class="form-control" id="importoCosto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <button type="button" id="saveCost" class="btn btn-primary">Salva</button>
                </div>
            </div>
        </div>
    </div>
    <script>

        $('.aggCosti').on('click', function () {

            $('#currentCostId').val('');

            $('#descrizioneCosto').val('');
            $('#importoCosto').val('');
            $('#costiModal').modal('show');

        })

     
        $(document).on("click", ".editCostRow", function (event) {
            event.preventDefault();
            let row = $(this).closest('tr');
            let costoId = row.data('costo-id');
            let descrizione = row.find('td:eq(0)').text();
            let importo = row.find('td:eq(1)').text().replace(' €', '');

            $('#currentCostId').val(costoId);
            $('#descrizioneCosto').val(descrizione);
            $('#importoCosto').val(importo);

            $('#costiModal').modal('show');
        })


        $('#saveCost').click(function () {

            let costoId = $('#currentCostId').val();
            let description = $("#descrizioneCosto").val();
            let amount = $("#importoCosto").val();

            if (!description || !amount) {
                alert('Per favore inserisci sia la descrizione che l\'importo.');
                return;
            }

            if (costoId) {
                // Esegui AJAX per aggiornare il costo
                let descrizione = $('#descrizioneCosto').val();
                let importo = $('#importoCosto').val();

                $.ajax({
                    url: `/interventi/costi/${costoId}/update`,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "descrizione": descrizione,
                        "importo": importo
                    },
                    success: function (result) {
                        // Aggiorna la riga della tabella
                        let row = $(`tr[data-costo-id="${costoId}"]`);
                        row.find('td:eq(0)').text(descrizione);
                        row.find('td:eq(1)').text(`${importo} €`);

                        $('#costiModal').modal('hide');
                    },
                    error: function (error) {
                        console.error("Errore durante la modifica del costo: ", error);
                    }
                });
            } else {
                // Logica per l'aggiunta di un nuovo costo
                let interventoId = $("#interventoId").val();
                $.ajax({
                    type: 'POST',
                    url: '/addCostiAgg',  // URL della tua funzione di aggiunta del costo
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'descrizione': description,
                        'importo': amount,
                        intervento_id: interventoId
                    },
                    success: function (response) {
                        // Fai qualcosa con la risposta, ad esempio aggiungi una nuova riga alla tabella
                        let newRow = `
                    <tr data-costo-id="${response.id_add}">
                        <td>${description}</td>
                        <td>${amount} €</td>
                        <td>
                          <button class="btn btn-success btn-sm editCostRow" data-id="${response.id_add}">Modifica</button>
                          <button class="btn btn-danger btn-sm removeCostRow" data-id="${response.id_add}">Elimina</button>
                        </td>
                    </tr>`;

                        $("#costiTable tbody").append(newRow);

                        // Svuota gli input nel modal
                        $("#descrizioneCosto").val('');
                        $("#importoCosto").val('');

                        // Chiudi il modal
                        $("#costiModal").modal('hide');
                    },
                    error: function (error) {
                        // Gestisci eventuali errori
                        console.error(error);
                    }
                });
            }
        });


        $(document).on("click", ".removeCostRow", function (event) {
            event.preventDefault();
            const row = $(this).closest('tr');
            const costoId = row.data('costo-id');

            $.ajax({
                url: '/delete/costo',  // l'URL definito nelle tue route
                method: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),  // CSRF token per la sicurezza
                    'id': costoId  // L'ID del costo che vuoi eliminare
                },
                success: function (response) {
                    if (response.status === 'success') {
                        row.remove();  // Rimuovi la riga dalla tabella
                    } else {
                        alert('Si è verificato un errore durante l\'eliminazione del costo.');
                    }
                },
                error: function (response) {
                    alert('Si è verificato un errore durante l\'eliminazione del costo.');
                }
            });
        });
    </script>
@endsection

