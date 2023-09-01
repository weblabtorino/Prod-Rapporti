<?php

namespace App\Http\Controllers;

use App\Models\Clienti;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clienti = Clienti::all();
        return view('clienti.index', compact('clienti'));
    }

    public function create()
    {
        return view('clienti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        Clienti::create($request->all());
        return redirect()->route('clienti.index')->with('success', 'Cliente aggiunto con successo!');
    }

    public function edit(Clienti $cliente)
    {
        return view('clienti.edit', compact('cliente'));
    }

    public function update(Request $request, Clienti $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clientis,email,' . $cliente->id,
        ]);

        $cliente->update($request->all());
        return redirect()->route('clienti.index')->with('success', 'Cliente aggiornato con successo!');
    }

    public function destroy(Clienti $cliente)
    {
        $cliente->delete();
        return redirect()->route('clienti.index')->with('success', 'Cliente eliminato con successo!');
    }
}
