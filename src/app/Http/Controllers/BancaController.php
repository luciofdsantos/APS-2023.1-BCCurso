<?php

namespace App\Http\Controllers;

use App\Models\Banca;
use App\Models\Professor;
use App\Models\ProfessorExterno;
use App\Models\Servidor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BancaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        if ($buscar) {
            $bancas = Banca::where('data', '=', date('Y-n-d', strtotime($buscar)));
        } else {
            $bancas = Banca::all();
        }

        return view('banca.index', [
            'buscar' => $buscar,
            'bancas' => $bancas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professores_externos = ProfessorExterno::all();
        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')->get();
        return view('banca.create', [
            'professores_externos' => $professores_externos,
            'professores_internos' => $professores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banca = Banca::create([
            'data' => $request->data,
            'local' => $request->local,
            'professor_id' => $request->presidente
        ]);

        if ($request->professores_internos != null) {
            foreach ($request->professores_internos as $professor_interno) {
                $professor_interno = Professor::findOrFail($professor_interno);

                $banca->professores()->attach($professor_interno);
            }
        }

        if ($request->professores_externos != null) {
            foreach ($request->professores_externos as $professor_externo_id) {
                $professor_externo = ProfessorExterno::findOrFail($professor_externo_id);

                $banca->professoresExternos()->attach($professor_externo);
            }
        }

        if ($request->contexto == 'modal') {
            $bancas = Banca::with('professoresExternos', 'professores.servidor')->get();
            return response()->json(['bancas' => $bancas]);
        }

        return redirect('banca')->with('success', 'Banca criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banca = Banca::findOrFail($id);
        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')->get();
        $professores_externos = ProfessorExterno::all();
        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')->get();

        return view('banca.show', [
            'banca' => $banca,
            'professores_externos' => $professores_externos,
            'professores_internos' => $professores
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $professores_externos = ProfessorExterno::all();
        $banca = Banca::findOrFail($id);
        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')->get();

        return view('banca.edit', [
            'banca' => $banca,
            'professores_externos' => $professores_externos,
            'professores_internos' => $professores
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banca = Banca::findOrFail($id);
        $banca->update([
            'data' => $request->data,
            'local' => $request->local,
            'professor_id' => $request->presidente
        ]);

        $banca->professoresExternos()->sync($request->professores_externos);
        $banca->professores()->sync($request->professores_internos);

        return redirect('banca')->with('success', 'Banca alterada com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banca = Banca::findOrFail($id);
            $banca->delete();
            $tipo = "success";
            $mensagem = 'Banca excluída com sucesso!';

        } catch(QueryException){
            $tipo = "error";
            $mensagem = 'Banca utilizada no sistema!';
        }

        return back()->with($tipo, $mensagem);
    }
}
