<?php

namespace App\Http\Controllers;

use App\Models\Coordenador;
use App\Models\Servidor;
use App\Models\Usuario;
use App\Models\AreaProfessor;
use App\Models\CurriculoProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoordenadorController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit($servidor_id)
    {

    }

    public function update(Request $request, $servidor_id)
    {
    }


    public function view($id)
    {
        $coordenador = Coordenador::find($id);
        $areas = AreaProfessor::where('professor_id', $coordenador->professor_id)->get();
        $curriculos = CurriculoProfessor::where('professor_id', $coordenador->professor_id)->get();

        return view(
            'coordenador.view',
            ['coordenador' => $coordenador, 'areas' => $areas, 'curriculos' => $curriculos]
        );
    }
}
