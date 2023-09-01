@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aggiungi Intervento</div>

                    <div class="card-body">
                        <form action="{{ route('interventi.store') }}" method="POST" id="interventiForm">
                            @csrf

                            <div class="row">
                                <!-- Prima Colonna: Campi Standard -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cliente_id">Cliente</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id" required>
                                            @foreach($clienti as $cliente)
                                                <option value="{{ $cliente->id }}" data-prezzo-orario="{{ $cliente->prezzo_orario }}"
                                                    {{ old('cliente_id', $intervento->cliente_id ?? null) == $cliente->id ? 'selected' : '' }}>
                                                    {{ $cliente->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="descrizione">Descrizione Intervento</label>
                                        <textarea class="form-control" name="descrizione" id="descrizione" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ore_lavorate">Ore Lavorate/Previste</label>
                                        <input type="number" class="form-control" name="ore_lavorate" id="ore_lavorate" step="0.1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="data_inizio">Data Inizio:</label>
                                        <input type="date" name="data_inizio" class="form-control" value="{{ old('data_inizio', $intervento->data_inizio ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="data_fine">Data Fine:</label>
                                        <input type="date" name="data_fine" class="form-control" value="{{ old('data_fine', $intervento->data_fine ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stato">Stato:</label>
                                        <select name="stato" class="form-control">
                                            <option value="programmato" {{ old('stato', $intervento->stato ?? '') == 'programmato' ? 'selected' : '' }}>Programmato</option>
                                            <option value="in_corso" {{ old('stato', $intervento->stato ?? '') == 'in_corso' ? 'selected' : '' }}>In Corso</option>
                                            <option value="completato" {{ old('stato', $intervento->stato ?? '') == 'completato' ? 'selected' : '' }}>Completato</option>
                                            <option value="cancellato" {{ old('stato', $intervento->stato ?? '') == 'cancellato' ? 'selected' : '' }}>Cancellato</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fatturato">Fatturato:</label>
                                        <input type="checkbox" name="fatturato" id="fatturato" value="1" {{ old('fatturato', $intervento->fatturato ?? false) ? 'checked' : '' }}>
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

                                        // Trigger the 'change' event initially to display the hourly rate of the selected customer when the page loads
                                        clienteDropdown.dispatchEvent(new Event('change'));
                                    </script>
                                </div>

                                <!-- Seconda Colonna: Costi Aggiuntivi -->
                                <div class="col-md-6">
                                    <h4>Costi Aggiuntivi</h4>
                                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#costiModal">
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
                                        <!-- Qui verranno inserite le righe con i costi aggiuntivi -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Fuori dalle colonne -->
                            <div class="form-group mt-3">
                                <label>Totale Intervento:</label>
                                <span id="totaleIntervento">0 €</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Salva Intervento</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modale per l'inserimento dei costi -->
        <div class="modal fade" id="costiModal" tabindex="-1" role="dialog" aria-labelledby="costiModalLabel" aria-hidden="true">
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
    </div>
    <script>

        let currentId = $("#costiTable tbody tr").length; // Conta le righe esistenti nella tabella per generare un ID univoco
        // Quando viene confermato un nuovo costo aggiuntivo
        $("#saveCost").click(function() {
            let description = $("#descrizioneCosto").val();
            let amount = $("#importoCosto").val();

            // Se la descrizione o l'importo sono vuoti, potresti voler mostrare un errore
            if (!description || !amount) {
                alert('Per favore inserisci sia la descrizione che l\'importo.');
                return;
            }

            // Aggiungi il costo alla tabella visiva
            let newRow = `
        <tr>
            <td>${description}</td>
            <td>${amount} €</td>
            <td><button class="btn btn-danger btn-sm removeCostRow">Elimina</button></td>
        </tr>
    `;
            $("#costiTable tbody").append(newRow);

            // Aggiungi input nascosti al form principale
            let hiddenDescriptionInput = `<input type="hidden" name="costs[${currentId}][description]" value="${description}">`;
            let hiddenAmountInput = `<input type="hidden" name="costs[${currentId}][amount]" value="${amount}">`;

            $("#interventiForm").append(hiddenDescriptionInput, hiddenAmountInput);

            // Incrementa l'ID per il prossimo inserimento
            currentId++;

            // Svuota gli input nel modal
            $("#descrizioneCosto").val('');
            $("#importoCosto").val('');

            // Chiudi il modal
            $("#costiModal").modal('hide');
        });

        // Elimina la riga corrispondente al costo e i suoi input nascosti
        $(document).on("click", ".removeCostRow", function() {
            let rowIndex = $(this).closest('tr').index();
            $(this).closest('tr').remove();

            // Rimuovi gli input nascosti corrispondenti
            $(`input[name="costs[${rowIndex}][description]"]`).remove();
            $(`input[name="costs[${rowIndex}][amount]"]`).remove();
        });

    </script>
@endsection

