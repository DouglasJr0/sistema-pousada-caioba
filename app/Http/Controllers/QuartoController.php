<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    public function index()
    {
        $quartos = Quarto::orderBy('numero')->get();
        return view('quartos.index', compact('quartos'));
    }

    public function create()
    {
        return view('quartos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:quartos,numero',
            'tipo' => 'required|string',
            'capacidade' => 'required|integer|min:1',
            'valor_diaria' => 'required|numeric|min:0',
            'status' => 'required|in:disponível,reservado,manutenção',
        ]);

        Quarto::create($request->all());

        return redirect()->route('quartos.index')->with('success', 'Quarto cadastrado com sucesso!');
    }

    public function edit(Quarto $quarto)
    {
        return view('quartos.edit', compact('quarto'));
    }

    public function update(Request $request, Quarto $quarto)
    {
        $request->validate([
            'numero' => 'required|unique:quartos,numero,' . $quarto->id,
            'tipo' => 'required|string',
            'capacidade' => 'required|integer|min:1',
            'valor_diaria' => 'required|numeric|min:0',
            'status' => 'required|in:disponível,reservado,manutenção',
        ]);

        $quarto->update($request->all());

        return redirect()->route('quartos.index')->with('success', 'Quarto atualizado com sucesso!');
    }

    public function destroy(Quarto $quarto)
    {
        $quarto->delete();
        return redirect()->route('quartos.index')->with('success', 'Quarto excluído com sucesso!');
    }
}
