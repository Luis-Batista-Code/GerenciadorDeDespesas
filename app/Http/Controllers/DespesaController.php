<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $despesas = Despesa::where('user_id', $userId)
            ->with('categoria')
            ->orderBy('data', 'desc')
            ->get();

        $categorias = Categoria::all();

        $total = $despesas->sum('valor');

        return view('dashboard', [
            'despesas'   => $despesas,
            'categorias' => $categorias,
            'total'      => $total,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao'    => 'required|string|max:255',
            'valor'        => 'required|numeric|min:0.01',
            'data'         => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Despesa::create([
            'descricao'    => $request->descricao,
            'valor'        => $request->valor,
            'data'         => $request->data,
            'categoria_id' => $request->categoria_id,
            'user_id'      => Auth::id(),
        ]);

        return redirect()->route('dashboard');
    }
}