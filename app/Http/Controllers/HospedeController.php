<?php

namespace App\Http\Controllers;

use App\Models\Hospede;
use Illuminate\Http\Request;

class HospedeController extends Controller
{
    public function index()
    {
        $hospedes = Hospede::latest()->get();

        return view('hospedes.index', compact('hospedes'));
    }

    public function create()
    {
        return view('hospedes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:14',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Hospede::create($request->all());

        return response()->json(['success' => true, 'message' => 'Hóspede cadastrado com sucesso!']);
    }

    public function edit(Hospede $hospede)
    {
        return response()->json($hospede);
    }

    public function update(Request $request, Hospede $hospede)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:14',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $hospede->update($request->all());

        return response()->json(['success' => true, 'message' => 'Hóspede atualizado com sucesso!']);
    }

    public function destroy(Hospede $hospede)
    {
        $hospede->delete();

        return response()->json(['success' => true, 'message' => 'Hóspede excluído com sucesso!']);
    }
}
