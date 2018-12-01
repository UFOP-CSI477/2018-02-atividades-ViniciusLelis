<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Registro;

class ManutencaoController extends Controller
{

    public function index()
    {
        // Recuperar todas as manutenções cadastradas
        $registros = Registro::all()->sortBy('datalimite');

        // Alterar cada registro para salvar o nome do equipamento ao invés do id dele
        foreach($registros as $reg)
        {
            $nome_equipamento = DB::table('equipamentos')->where('id', $reg->equipamento_id)->value('nome');
            $reg->setNomeEquipamento($nome_equipamento);
        }

        return view('relatorios', compact('registros'));
    }

    public function create()
    {
        $sidebar_selected = 2;
        return view('administracao', compact('sidebar_selected'));
    }

    public function search(Request $request)
    {
        $sidebar_selected = 3;
        
        if ($request->has('search_equipamento_id')) {
            $request->validate(['search_equipamento_id'=>'required|integer']);
            $search_parameter = $request->get('search_equipamento_id');
            $registros = Registro::all()->where('equipamento_id', $search_parameter)->sortBy('datalimite');
            $nome_equipamento = DB::table('equipamentos')->where('id', $search_parameter)->value('nome');
            foreach($registros as $reg)
            {
                $reg->setNomeEquipamento($nome_equipamento);
            }

            return view('administracao', compact('registros', 'sidebar_selected'));
        }
        return view('administracao', compact('sidebar_selected'));
    }

    public function store(Request $request)
    {
        $request->validate(
            ['equipamento_id'=>'required|integer', 
            'descricao'=>'required|max:191',
            'datalimite'=>'required|date',
            'tipo'=>'required|integer']);
        $registro = new Registro(
            ['equipamento_id' => $request->get('equipamento_id'),
            'descricao' => $request->get('descricao'),
            'datalimite' => $request->get('datalimite'),
            'tipo' => $request->get('tipo')]);
        $registro->save();
        return redirect('relatorios')->with('success', 'Equipamento cadastrado com sucesso');
    }
}
