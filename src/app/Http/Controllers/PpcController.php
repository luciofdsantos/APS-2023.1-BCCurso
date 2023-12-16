<?php

namespace App\Http\Controllers;

use App\Http\Requests\PpcRequest;
use App\Models\PPC;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PpcController extends Controller
{
    public function index($cursoId)
    {
        $curso = Curso::find($cursoId);

        if (!$curso) {
            abort(404, 'Curso não encontrado');
        }

        $ppcs = $curso->ppc()->orderByDesc('vigente')->get();

        return view('ppc.index', ['ppcs' => $ppcs, 'curso' => $curso]);
    }
    
    public function create($cursoId) {
        return view('ppc.create',['cursoId' => $cursoId]);
    }

    public function store(PpcRequest $request, $cursoId)
    {
        $curso = Curso::find($cursoId);

        if (!$curso) {
            abort(404, 'Curso não encontrado');
        }

        $ppcPath = null;
        if($request->hasFile("ppc")) {
            $ppc = $request->file("ppc");
            $ppcPath = $ppc->store('ArquivoPPC');
        }

        $matrizCurricularPath = null;
        if($request->hasFile("matriz_curricular")) {
            $matriz_curricular = $request->file("matriz_curricular");
            $matrizCurricularPath = $matriz_curricular->store('ArquivoMatrizCurricular');
        }

        if($ppcPath){

            if($request->filled('vigente')) {
                $ppc_antigo = PPC::where('vigente',true)->first();
                if($ppc_antigo){
                    $ppc_antigo->vigente = false;
                    $ppc_antigo->save();
                }
            }

            $ppc_criado = $curso->ppc()->create([
                'path' => $ppcPath,
                'nome' => $ppc->getClientOriginalName(),
                'vigente' => $request->filled('vigente'),
            ]);

            if($matrizCurricularPath){
                $ppc_criado->matriz()->create([
                    'path' => $matrizCurricularPath,
                    'nome' => $matriz_curricular->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('ppc.index', ['cursoId' => $cursoId])->with('success', 'PPC adicionado com sucesso');
    }

    public function edit($cursoId, $ppcId)
    {
        $curso = Curso::find($cursoId);

        if (!$curso) {
            abort(404, 'Curso não encontrado');
        }

        $ppc = Ppc::find($ppcId);

        if (!$ppc || $ppc->curso_id != $cursoId) {
            abort(404, 'PPC não encontrado');
        }

        return view('ppc.edit', ['cursoId' => $curso->id, 'ppc' => $ppc]);
    }

    public function update(PpcRequest $request, $cursoId, $ppcId){

        $curso = Curso::find($cursoId);

        if (!$curso) {
            abort(404, 'Curso não encontrado');
        }

        $ppc = Ppc::find($ppcId);

        if (!$ppc || $ppc->curso_id != $cursoId) {
            abort(404, 'PPC não encontrado');
        }

        if ($request->hasFile('ppc') && $ppc->path) {
            File::delete(storage_path('app/public/' . $ppc->path));
        }

        if ($request->hasFile('ppc')) {
            $ppc->path = $request->file('ppc')->store('ArquivoPPC');
            $ppc->nome = $request->file('ppc')->getClientOriginalName();
        }

        if ($request->hasFile('matriz_curricular')) {
            if ($ppc->matriz && $ppc->matriz->path) {
                File::delete(storage_path('app/public/' . $ppc->matriz->path));
            }

            $matrizCurricularPath = $request->file('matriz_curricular')->store('ArquivoMatrizCurricular');

            if (!$ppc->matriz) {
                $ppc->matriz()->create([
                    'nome' => $request->file('matriz_curricular')->getClientOriginalName(),
                    'path' => $matrizCurricularPath,
                ]);
            } else {
                $ppc->matriz->update([
                    'nome' => $request->file('matriz_curricular')->getClientOriginalName(),
                    'path' => $matrizCurricularPath,
                ]);
            }
        }

        $ppc->vigente = $request->has('vigente') ? true : false;

        if($ppc->vigente) {
            $ppc_antigo = PPC::where('vigente',true)->first();
            if($ppc_antigo){
                $ppc_antigo->vigente = false;
                $ppc_antigo->save();
            }
        }

        $ppc->save();

        return redirect()->route('ppc.index', ['cursoId' => $cursoId])->with('success', 'PPC atualizado com sucesso');
    }

    public function destroy($cursoId, $ppcId)
    {
        $curso = Curso::find($cursoId);

        if (!$curso) {
            abort(404, 'Curso não encontrado');
        }

        $ppc = Ppc::find($ppcId);

        if (!$ppc || $ppc->curso_id != $cursoId) {
            abort(404, 'PPC não encontrado');
        }

        if ($ppc->path) {
            File::delete(storage_path('app/public/' . $ppc->path));
        }

        if ($ppc->matriz && $ppc->matriz->path) {
            File::delete(storage_path('app/public/' . $ppc->matriz->path));
        }

        $ppc->matriz()->delete();

        $ppc->delete();

        return redirect()->route('ppc.index', ['cursoId' => $cursoId])->with('success', 'PPC excluído com sucesso');
    }
}
