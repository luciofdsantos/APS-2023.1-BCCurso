<?php

namespace App\Http\Controllers;

use App\Http\Requests\TccRequest;
use App\Models\Aluno;
use App\Models\ArquivoTcc;
use App\Models\Banca;
use App\Models\Professor;
use App\Models\ProfessorExterno;
use App\Models\Servidor;
use App\Models\Tcc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TccController extends Controller
{
    public function index(Request $request)
    {
        $tccs = Tcc::all();
        $professores = Servidor::join('professor', 'professor.servidor_id', '=', 'servidor.id')->get();

        return view('tcc.index', ['tccs' => $tccs, 'professores' => $professores]);
    }

    public function create()
    {

        $anoAtual = date("Y");

        $professores = Servidor::join('professor', 'servidor.id', '=', 'professor.servidor_id')->get();
        $professoresExternos = ProfessorExterno::all();
        $bancas = Banca::all();
        $alunos = Aluno::pluck('nome', 'id');
        $id = 1;
        return view('tcc.create', ['anoAtual' => $anoAtual, 'alunos' => $alunos, 'bancas' => $bancas, 'professores' => $professores, 'professores_externos' => $professoresExternos, 'id' => $id]);
    }

    public function store(TccRequest $request)
    {
        $orientador = Professor::find($request->professor_id);

        $tcc = new Tcc([
            'titulo' => $request->titulo,
            'resumo' => $request->resumo,
            'ano' => $request->ano,
            'aluno_id' => $request->aluno_id,
            'banca_id' => $request->banca_id,
            'status' => $request->status
        ]);

        if ($request->hasFile("arquivo")) {
            $pdf = new ArquivoTcc();
            $pdf->nome = $request->arquivo->getClientOriginalName();
            $pdf->path = $request->arquivo->store('ArquivoTcc/' . $tcc->id);
            $pdf->save();
            $tcc->arquivo_id = $pdf->id;
        }
        $orientador->tccs()->save($tcc);


        if ($request->convite) {
            return redirect()->route('postagem.create')->withInput();
        }

        return redirect('tcc')->with('success', 'TCC cadastrado com sucesso');
    }

    public function edit($id)
    {

        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')
            ->select('professor.id', 'professor.servidor_id', 'servidor.nome')
            ->get();
        $professoresExternos = ProfessorExterno::all();
        $tcc = Tcc::find($id);
        $alunos = Aluno::all();
        $alunoId = $tcc->aluno_id;

        $bancas = Banca::all();
        return view('tcc.edit', ['anoTcc' => $tcc->ano, 'tcc' => $tcc, 'alunos' => $alunos, 'bancas' => $bancas, 'professores' => $professores, 'professores_externos' => $professoresExternos, 'id' => $alunoId]);
    }

    public function update(Request $request, $id)
    {
        $tcc = Tcc::find($request->id);

        if ($request->contexto === 'concluiTcc') {
            if ($request->hasFile("arquivo")) {
                $pdf = new ArquivoTcc();
                $pdf->nome = $request->arquivo->getClientOriginalName();
                $pdf->path = $request->arquivo->store('ArquivoTcc/' . $tcc->id);
                $pdf->save();

                $tcc->arquivo_id = $pdf->id;
            }

            $tcc->status = 1;
            $tcc->save();

            return redirect('tcc')->with('success', 'TCC atualizado com sucesso');
        }

        $tcc->update([
            'titulo' => $request->titulo,
            'resumo' => $request->resumo,
            'link' => $request->link,
            'ano' => $request->ano,
            'aluno_id' => $request->aluno_id,
            'status' => $request->status,
            'banca_id' => $request->banca_id
        ]);
        $professor = Professor::findOrFail($request->professor_id);

        if ($request->hasFile("arquivo")) {
            if ($tcc->arquivo) {
                $caminhoArquivo = $tcc->arquivo->path;

                $tcc->arquivo_id = null;
                $tcc->save();

                Storage::delete($caminhoArquivo);
                $tcc->arquivo->delete();
            }

            $pdf = new ArquivoTcc();
            $pdf->nome = $request->arquivo->getClientOriginalName();
            $pdf->path = $request->arquivo->store('ArquivoTcc/' . $tcc->id);
            $pdf->save();
            $tcc->arquivo_id = $pdf->id;
            $tcc->save();
        }

        $tcc->professor_id = $professor->id;
        $tcc->save();


        return redirect('tcc')->with('success', 'TCC atualizado com sucesso');
    }

    public function concluiTcc(Request $request)
    {
        $tcc = Tcc::find($request->id);

        if ($request->hasFile("arquivo")) {
            $pdf = new ArquivoTcc();
            $pdf->nome = $request->arquivo->getClientOriginalName();
            $pdf->path = $request->arquivo->store('ArquivoTcc/' . $tcc->id);
            $pdf->save();

            $tcc->arquivo_id = $pdf->id;
        }
        $tcc->status = true;

        $tcc->save();
        return redirect('tcc')->with('success', 'TCC concluído com sucesso');
    }

    public function destroy($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->delete();

        return back()->with('success', 'TCC excluido com sucesso');
    }

    public function search(Request $request)
    {
        $tituloBusca = $request->tituloBusca;

        if (!$tituloBusca) {
            return redirect('/tcc');
        }

        $tccs = Aluno::join('tcc', 'aluno.id', '=', 'tcc.aluno_id')
            ->where('tcc.titulo', 'like', '%' . $tituloBusca . '%')
            ->get();

        return view('tcc.index', ['tccs' => $tccs]);
    }

    public function show()
    {

        $tccs = Aluno::join('tcc', 'aluno.id', '=', 'tcc.aluno_id')
            ->leftJoin('banca', 'tcc.banca_id', '=', 'banca.id')
            ->leftJoin('professor', 'tcc.professor_id', '=', 'professor.id')
            ->leftJoin('servidor', 'professor.servidor_id', '=', 'servidor.id')
            ->select('tcc.*', 'aluno.nome', 'banca.local as local', 'servidor.nome as nome_professor')
            ->orderBy('tcc.ano', 'DESC')
            ->get();

        $professores = [];

        foreach ($tccs as $tcc) {
            $professorNome = $tcc->nome_professor;

            if (!isset($professores[$professorNome])) {
                $professores[$professorNome] = [];
            }

            $professores[$professorNome][] = $tcc;
        }

        $tccsPorAno = [];

        foreach ($tccs as $tcc) {
            $ano = $tcc->ano;

            if (!isset($tccsPorAno[$ano])) {
                $tccsPorAno[$ano] = [];
            }

            $tccsPorAno[$ano][] = $tcc;
        }

        krsort($tccsPorAno);
        ksort($professores);


        return view('tcc.show', ['professores' => $professores, 'tccsPorAno' => $tccsPorAno]);
    }

    public function view($id)
    {
        $tcc = Tcc::find($id);
        $aluno = Aluno::where('id', $tcc->aluno_id)->first();
        $banca = Banca::where('id', $tcc->banca_id)->first();
        $orientador = Professor::where('professor.id', $tcc->professor_id)
            ->leftJoin('servidor', 'professor.servidor_id', '=', 'servidor.id')
            ->select('professor.id', 'servidor.nome')
            ->first();

        $professores = Professor::join('servidor', 'professor.servidor_id', '=', 'servidor.id')->get();


        if (!$tcc) {
            abort(404);
        }

        return view('tcc.view', ['tcc' => $tcc, 'aluno' => $aluno, 'banca' => $banca, 'orientador' => $orientador, 'professores_internos' => $professores]);
    }
}
