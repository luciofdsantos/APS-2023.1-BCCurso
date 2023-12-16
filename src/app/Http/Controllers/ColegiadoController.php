<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\ArquivoPortaria;
use App\Models\Ata;
use App\Models\Colegiado;
use App\Models\Coordenador;
use App\Models\Professor;
use App\Models\Servidor;
use Illuminate\Http\Request;

class ColegiadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colegiado_atual = Colegiado::where('atual', '=', 1)
            ->first();

        if ($colegiado_atual != null) {
            $colegiados = Colegiado::whereNotIn('id', [$colegiado_atual->id])
                ->orderBy('numero_portaria', 'desc')
                ->get();
        } else {
            $colegiados = Colegiado::orderBy('numero_portaria', 'desc')
                ->get();
        }

        $atas = Ata::all();


        return view('colegiado.index', ['colegiados' => $colegiados,
        'colegiado_atual' => $colegiado_atual,
        'atas' => $atas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alunos = Aluno::all();
        $professores = Professor::all();
        $servidores = Servidor::whereNotIn('id', function ($query) {
            $query->select('servidor_id')->from('professor');
        })->get();

        $hoje = date('d-m-Y');

        return view('colegiado.create', ['alunos' => $alunos, 'professores' => $professores, 'servidores' => $servidores, 'hoje' => $hoje]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coordenador = Coordenador::first();
        $atual = $request->atual === 'on' ? 1 : 0;

        if ($atual == 1) {
            $colegiado_anterior = Colegiado::where('atual', '=', true)
                ->first();

            if ($colegiado_anterior) {
                $colegiado_anterior->update([
                    'atual' => false
                ]);
            }
        }

        $colegiado = new Colegiado([
            'numero_portaria' => $request->numero_portaria,
            'inicio' => $request->vigencia_inicio,
            'fim' => $request->vigencia_fim,
            'coordenador_id' => $coordenador->id,
            'atual' => $atual
        ]);

        $arquivo = $request->file('arquivo');
        $pdf = new ArquivoPortaria();
        $pdf->nome = $arquivo->getClientOriginalName();
        $pdf->path = $arquivo->store('ArquivoPortaria/' . $colegiado->id);
        $pdf->save();

        $colegiado->arquivo_portaria_id = $pdf->id;
        $colegiado->save();

        foreach ($request->professores_internos as $professor) {
            $colegiado->professores()->attach($professor);
        }
        foreach ($request->alunos as $aluno) {
            $colegiado->alunos()->attach($aluno);
        }
        foreach ($request->servidores as $tecnico_adm) {
            $colegiado->tecnicosAdm()->attach($tecnico_adm);
        }

        return redirect('colegiado')->with('success', 'Colegiado cadastrado com sucesso!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alunos = Aluno::all();
        $professores = Professor::all();
        $servidores = Servidor::whereNotIn('id', function ($query) {
            $query->select('servidor_id')->from('professor');
        })->get();

        $colegiado = Colegiado::find($id);

        $hoje = date('d-m-Y');

        return view('colegiado.edit', ['colegiado' => $colegiado, 'alunos' => $alunos, 'professores' => $professores, 'servidores' => $servidores, 'hoje' => $hoje]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $colegiado = Colegiado::find($request->id);

        if($request->update_to_atual) {
            $colegiado_anterior = Colegiado::where('atual', '=', true)
                ->first();

            if ($colegiado_anterior) {
                $colegiado_anterior->update([
                    'atual' => false
                ]);

                $colegiado->update([
                    'atual' => true
                ]);
            }
            return redirect('colegiado')->with('success', 'Colegiado atualizado com sucesso');
        }

        $coordenador = Coordenador::first();
        $atual = ($request->atual === 'on' ? 1 : 0);

        if ($atual == 1) {
            $colegiado_anterior = Colegiado::where('atual', '=', true)
                ->first();

            if ($colegiado_anterior) {
                $colegiado_anterior->update([
                    'atual' => false
                ]);
            }
        }

        $colegiado->update([
            'numero_portaria' => $request->numero_portaria,
            'inicio' => $request->vigencia_inicio,
            'fim' => $request->vigencia_fim,
            'coordenador_id' => $coordenador->id,
            'atual' => $atual
        ]);

        if ($request->hasFile("arquivo")) {
            $arquivo = $request->file('arquivo');
            $pdf = new ArquivoPortaria();
            $pdf->nome = $arquivo->getClientOriginalName();
            $pdf->path = $arquivo->store('ArquivoPortaria/' . $colegiado->id);
            $pdf->save();
        }

        $colegiado->professores()->sync($request->professores_internos);
        $colegiado->tecnicosAdm()->sync($request->servidores);
        $colegiado->alunos()->sync($request->alunos);

        return redirect('colegiado')->with('success', 'Colegiado alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $colegiado = Colegiado::findOrFail($id);
        $colegiado->delete();
        return back()->with('success', 'Colegiado excluído com sucesso');
    }

    public function show()
    {

        // Encontre o colegiado com base no ID
        $colegiado_atual = new Colegiado();
        $colegiado_atual = Colegiado::where('atual', '=', true)->first();

        if ($colegiado_atual != null) {
            $colegiados = Colegiado::whereNotIn('id', [$colegiado_atual->id])->get();
        } else {
            $colegiados = Colegiado::all();
        }

        if ($colegiado_atual != null) {
            $colegiado = $colegiado_atual;
            $presidente = $colegiado->presidente;
            $arquivoPortaria = $colegiado->arquivoPortaria;
            $professores = $colegiado->professores;
            $alunos = $colegiado->alunos;
            $tecnicosAdm = $colegiado->tecnicosAdm;
            $atas = $colegiado->atas;
        } else {
            $colegiado = null;
            $presidente = null;
            $arquivoPortaria = null;
            $professores = [];
            $alunos = [];
            $tecnicosAdm = [];
            $atas = [];
        }

        return view('colegiado.show', [
            'colegiado' => $colegiado,
            'presidente' => $presidente,
            'arquivoPortaria' => $arquivoPortaria,
            'professores' => $professores,
            'alunos' => $alunos,
            'tecnicosAdm' => $tecnicosAdm,
            'atas' => $atas,
        ]);
    }
}
