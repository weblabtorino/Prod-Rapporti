<?php

namespace App\Http\Controllers;

use App\Models\Interventi;
use App\Models\SottoIntervento;
use Illuminate\Http\Request;

class SottoInterventoController extends Controller
{
    public function create($intervento)
    {


        $interventi = Interventi::where('id', $intervento)->first();
        return view('sottoInterventi.create', compact('intervento','interventi'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'intervento_id' => 'required|integer|exists:interventis,id',
            'descrizione' => 'required|string|max:255',
            'data' => 'required|date',
            'ora_inizio' => 'required|date_format:H:i',
            'ora_fine' => 'required|date_format:H:i|after:ora_inizio',
        ]);

        $sottoIntervento = new SottoIntervento($validatedData);
        $sottoIntervento->save();

        return redirect()->route('interventi.show', $validatedData['intervento_id']);
    }

}
