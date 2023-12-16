<?php

namespace App\Http\Controllers;

use App\Models\ProfessorExterno;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class professorExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        if ($buscar) {
            $professores_externos = ProfessorExterno::where('nome', 'like', '%' . $buscar . '%')->get();
        } else {
            $professores_externos = ProfessorExterno::all();
        }

        if ($request->contexto) {
            $professores_externos = ProfessorExterno::all();
            return response()->json(['professoresExternos' => $professores_externos]);
        }

        return view('professor-externo.index', ['professores_externos' => $professores_externos, 'buscar' => $buscar]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProfessorExterno::create([
            'nome' => $request->nome,
            'filiacao' => $request->filiacao
        ]);
        if ($request->contexto == 'modal') {
            $professores = ProfessorExterno::all();
            return response()->json(['professores_externos' => $professores]);
        } else {
            return redirect('professor-externo')->with('success', 'Professor externo ' . $request->nome . ' Criado com Sucesso');
        }
    }
}
