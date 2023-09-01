<?php

namespace App\Http\Controllers;

use App\Models\Clienti;
use App\Models\CostoAggiuntivo;
use App\Models\Interventi;
use PDF;
use Illuminate\Http\Request;


class InterventoController extends Controller
{
    public function index()
    {
        $interventi = Interventi::all();
        return view('interventi.index', compact('interventi'));
    }

    public function show(Interventi $intervento)
    {
        return view('interventi.show', compact('intervento'));
    }

    public function create()
    {
        $clienti = Clienti::all();
        return view('interventi.create', compact('clienti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|integer',
            'descrizione' => 'required|string',
            'ore_lavorate' => 'required|numeric',
            'prezzo_orario' => 'required|numeric|min:0',
        ]);

        $interventiData = Interventi::create($request->all());

        // Se ci sono costi aggiuntivi, li salva
        if($request->has('costs') && is_array($request->costs)) {
            foreach($request->costs as $cost) {
                CostoAggiuntivo::create([
                    'intervento_id' => $interventiData->id,
                    'descrizione' => $cost['description'],
                    'importo' => $cost['amount']
                ]);
            }
        }

        return redirect()->route('interventi.index')->with('success', 'Intervento creato con successo!');
    }

    public function edit(Interventi $intervento)
    {

        $clienti = Clienti::all();
        $interventoCosti = Interventi::with('costiAggiuntivi')->find($intervento->id);
        return view('interventi.edit', compact('intervento', 'clienti','interventoCosti'));
    }

    public function update(Request $request, Interventi $intervento)
    {
        $request->validate([
            'cliente_id' => 'required|integer',
            'descrizione' => 'required|string',
            'ore_lavorate' => 'required|numeric',
            'prezzo_orario' => 'required|numeric|min:0',
        ]);

        $intervento->update($request->all());
        return redirect()->route('interventi.index')->with('success', 'Intervento aggiornato con successo!');
    }

    public function destroy(Interventi $intervento)
    {
        $intervento->delete();
        return redirect()->route('interventi.index')->with('success', 'Intervento eliminato con successo!');
    }

    public function generatePDF($intervento_id)
    {
//        $intervento = Interventi::findOrFail($intervento_id);

        $intervento = [
            'azienda' => [
                'nome' => 'La Tua Azienda',
                'indirizzo' => 'Via Esempio, 123',
                'codice_fiscale' => 'XYZ1234567',
                'partita_iva' => '0123456789',
                'logo' => 'https://placekitten.com/200/200' // Link a una immagine di un gattino, come esempio.
            ],
            'id' => '12345',
            'data' => '13/08/2023',
            'cliente' => [
                'nome' => 'Nome Cliente',
                'indirizzo' => 'Via Cliente, 456',
                'citta' => 'Città Cliente',
                'piva' => '9876543210'
            ],
            'dati_banca' => [
                'iban' => 'IT60X0542811101000000123456',
                'cc' => '001234567',
                'cab' => '12345',
                'abi' => '05428'
            ],
            'items' => [
                [
                    'descrizione' => 'Prodotto 1',
                    'quantita' => 2,
                    'prezzo_unitario' => 50.00
                ],
                [
                    'descrizione' => 'Prodotto 2',
                    'quantita' => 1,
                    'prezzo_unitario' => 100.00
                ]
            ],
            'totale' => 200.00
        ];




        $pdf = PDF::loadView('interventi.pdf2', ['intervento' => $intervento]);

        return $pdf->download('intervento-' . $intervento_id . '.pdf');
    }

    public function calendarData()
    {
        $interventi = Interventi::all();

        $colorMap = [
            'programmato' => 'blue',
            'in_corso' => 'orange',
            'completato' => 'green',
            'cancellato' =>'red',
            // altri stati e colori come necessario
        ];

        $interventiForCalendar = $interventi->map(function ($intervento) use ($colorMap) {
            return [
                'id' => $intervento->id,
                'title' => $intervento->cliente->nome,
                'description' => $intervento->descrizione,
                'start' => $intervento->data_inizio,
                'end' => $intervento->data_fine,
                'color' => $colorMap[$intervento->stato] ?? 'gray',  // Se per qualche motivo lo stato non è mappato, usa il grigio come colore predefinito
                // Puoi aggiungere altri campi come colore, ecc.
            ];
        });

        return response()->json($interventiForCalendar);
    }

    public function addCostiAgg(Request $request)
    {
        try {
            // Validazione dei dati inviati. Adatta secondo le tue esigenze.
            $request->validate([
                'descrizione' => 'required|string',
                'importo' => 'required|numeric|min:0',
                'intervento_id' => 'required|integer',  // se stai inviando l'ID dell'intervento
            ]);

            // Creazione del nuovo costo aggiuntivo nel database.
            $costoAggiuntivo = new CostoAggiuntivo();
            $costoAggiuntivo->descrizione = $request->descrizione;
            $costoAggiuntivo->importo = $request->importo;
            $costoAggiuntivo->intervento_id = $request->intervento_id;  // se stai inviando l'ID dell'intervento

            $costoAggiuntivo->save();

            return response()->json([
                'success' => true,
                'id_add' => $costoAggiuntivo->id,
                'message' => 'Costo aggiuntivo aggiunto con successo.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Si è verificato un errore durante l\'aggiunta del costo aggiuntivo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateCost($id, Request $request)
    {
        $costo = CostoAggiuntivo::find($id);
        $costo->descrizione = $request->descrizione;
        $costo->importo = $request->importo;
        $costo->save();

        return response()->json(['status' => 'success']);
    }

    public function deleteCostiAgg(Request $request)
    {
        $id = $request->input('id');
        $costo = CostoAggiuntivo::find($id);
        if ($costo) {
            $costo->delete();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Costo non trovato'], 404);
        }
    }
}
