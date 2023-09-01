<?php

namespace App\Http\Controllers;

use App\Models\Fatture;
use Illuminate\Http\Request;

class FatturaController extends Controller
{
    public function index()
    {
        $fatture = Fatture::all();
        return view('fatture.index', compact('fatture'));
    }

    public function create()
    {
        return view('fatture.create');
    }

    public function store(Request $request)
    {
        Fatture::create($request->all());
        return redirect()->route('fatture.index');
    }

    public function edit(Fatture $fattura)
    {
        return view('fatture.edit', compact('fattura'));
    }

    public function update(Request $request, Fatture $fattura)
    {
        $fattura->update($request->all());
        return redirect()->route('fatture.index');
    }

    public function destroy(Fatture $fattura)
    {
        $fattura->delete();
        return redirect()->route('fatture.index');
    }

    public function show(Fatture $fattura)
    {
        return view('fatture.show', compact('fattura'));
    }
}
