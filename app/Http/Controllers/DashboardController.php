<?php

namespace App\Http\Controllers;

use App\Models\Clienti;
use App\Models\Interventi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $unMeseFa = Carbon::now()->subMonth();

        $interventiUltimoMese = Interventi::where('created_at', '>', $unMeseFa)->count();
        $nuoviClientiUltimoMese = Clienti::where('created_at', '>', $unMeseFa)->count();
        $prossimiInterventi = Interventi::where('data_inizio', '>', Carbon::now())->orderBy('data_inizio', 'asc')->take(5)->get();

        $interventiOggi = Interventi::where('data_inizio', Carbon::today())->get();
        $interventiDaFatturare = Interventi::where('fatturato', false)
            ->where('stato','completato')
            ->get();

        $mesi = [];
        $interventiMensili = [];

        for ($i = 11; $i >= 0; $i--) {
            $mese = now()->subMonths($i);
            $mesi[] = $mese->format('F Y');
            $interventiMensili[] = Interventi::whereMonth('data_inizio', $mese->month)->whereYear('data_inizio', $mese->year)->count();
        }

        $clienti = Clienti::withCount('interventi')->get();
        $labels = [];
        $data = [];

        foreach ($clienti as $cliente) {
            $labels[] = $cliente->nome;
            $data[] = $cliente->interventi_count;
        }


        return view('home', compact('interventiUltimoMese', 'nuoviClientiUltimoMese', 'interventiOggi', 'interventiDaFatturare','mesi', 'interventiMensili','labels', 'data'));
    }
}
