<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipamento;

class EquipamentoController extends Controller
{
    public function index()
    {
        $sidebar_selected = 1;
        $equipamentos = Equipamento::all()->sortBy('nome', SORT_NATURAL|SORT_FLAG_CASE);
        return view('administracao', compact('equipamentos', 'sidebar_selected'));
    }

    public function create() 
    {
        $sidebar_selected = 0;
        return view('administracao', compact('sidebar_selected'));
    }

    public function store(Request $request)
    {
        $request->validate(['nome'=>'required|max:50']);
        $equipamento = new Equipamento(['nome' => $request->get('nome')]);
        $equipamento->save();

        return redirect('/administracao/listar_equipamentos')->with('success', 'Equipamento cadastrado com sucesso');
    }
}
