<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Models\Coordenador;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class CursoController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if ($buscar) {
            $cursos = Curso::where('nome', 'like', '%' . $buscar . '%')->get();
        } else {
            $cursos = Curso::all();
        }

        return view('curso.index', ['cursos' => $cursos, 'buscar' => $buscar]);
    }

    public function create()
    {
        return view('curso.create');
    }

    public function store(CursoRequest $request)
    {
        $calendario = null;
        $nomeCalendario = $request->calendario;
        if ($request->hasFile("calendario")) {
            $calendario = $request->file("calendario");
            $nomeCalendario = $calendario->store('ArquivoCalendario');
        }

        $horario = null;
        $nomeHorario = $request->horario;
        if ($request->hasFile("horario")) {
            $horario = $request->file("horario");
            $nomeHorario = $horario->store('ArquivoHorario');
        }

        $curso = new Curso([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'turno' => $request->turno,
            'carga_horaria' => $request->carga_horaria,
            'sigla' => $request->sigla,
            'analytics' => $request->analytics,
            'calendario' => $nomeCalendario,
            'horario' => $nomeHorario,
            'modalidade' => $request->modalidade,
            'tipo' => $request->tipo,
            'habilitacao' => $request->habilitacao,
            'ano_implementacao' => $request->ano_implementacao,
            'vagas_ofertadas_anualmente' => $request->vagas_ofertadas_anualmente,
            'vagas_ofertadas_turma' => $request->vagas_ofertadas_turma,
            'periodicidade_ingresso' => $request->periodicidade_ingresso,
            'tempo_min_conclusao' => $request->tempo_min_conclusao,
            'tempo_max_conclusao' => $request->tempo_max_conclusao,
            'nota_enade' => $request->nota_enade,
            'nota_in_loco_SINAES' => $request->nota_in_loco_SINAES,
        ]);

        $curso->save();

        $ato_autorizacao = $request->file("ato_autorizacao");

        if ($ato_autorizacao && $ato_autorizacao->isValid()) {
            $diretorio = 'ArquivoAtoAutorizacao';
            $nomeAtoAutorizacao = $ato_autorizacao->store($diretorio);

            $curso->atoAutorizacao()->create([
                'nome' => $ato_autorizacao->getClientOriginalName(),
                'path' => $nomeAtoAutorizacao,
            ]);
        }

        $formasAcesso = $request->formas_acesso;

        $percent = null;
        if ($formasAcesso != null) {
            foreach ($formasAcesso as $formaAcesso) {
                if ($formaAcesso == "SISU") {
                    $percent = $request->sisu_percent;
                } else if ($formaAcesso == "Vestibular") {
                    $percent = $request->vestibular_percent;
                }

                $curso->formasAcesso()->create([
                    'forma_acesso' => $formaAcesso,
                    'porcentagem_vagas' => $percent,
                ]);
            }
        }

        return redirect('curso')->with('success', 'Curso adicionado com sucesso');
    }

    public function edit($curso_id)
    {
        $curso = Curso::where('id', $curso_id)->first();
        return view('curso.edit', ['curso' => $curso]);
    }

    public function update(CursoRequest $request, $id)
    {
        $curso = Curso::find($id);

        if (!$curso) {
            return redirect('curso')->with('error', 'Curso não encontrado');
        }
        $calendario = null;
        $nomeCalendario = $curso->calendario;
        if ($request->hasFile("calendario")) {
            $calendario = $request->file("calendario");
            $nomeCalendario = $calendario->store('ArquivoCalendario');
        }

        $horario = null;
        $nomeHorario = $curso->horario;
        if ($request->hasFile("horario")) {
            $horario = $request->file("horario");
            $nomeHorario = $horario->store('ArquivoHorario');
        }

        $curso->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'turno' => $request->turno,
            'carga_horaria' => $request->carga_horaria,
            'sigla' => $request->sigla,
            'analytics' => $request->analytics,
            'calendario' => $nomeCalendario,
            'horario' => $nomeHorario,
            'modalidade' => $request->modalidade,
            'tipo' => $request->tipo,
            'habilitacao' => $request->habilitacao,
            'ano_implementacao' => $request->ano_implementacao,
            'vagas_ofertadas_anualmente' => $request->vagas_ofertadas_anualmente,
            'vagas_ofertadas_turma' => $request->vagas_ofertadas_turma,
            'periodicidade_ingresso' => $request->periodicidade_ingresso,
            'tempo_min_conclusao' => $request->tempo_min_conclusao,
            'tempo_max_conclusao' => $request->tempo_max_conclusao,
            'nota_enade' => $request->nota_enade,
            'nota_in_loco_SINAES' => $request->nota_in_loco_SINAES,
        ]);

        $this->updateFormasAcesso($curso, $request);

        $ato_autorizacao = $request->file("ato_autorizacao");


        if ($ato_autorizacao && $ato_autorizacao->isValid()) {

            if($curso->atoAutorizacao->path) {
                File::delete(storage_path('app/public/' . $curso->atoAutorizacao->path));
            }

            $diretorio = 'ArquivoAtoAutorizacao';
            $nomeAtoAutorizacao = $ato_autorizacao->store($diretorio);

            $curso->atoAutorizacao()->update([
                'nome' => $ato_autorizacao->getClientOriginalName(),
                'path' => $nomeAtoAutorizacao,
            ]);
        }


        return redirect('curso')->with('success', 'Curso atualizado com sucesso');
    }

    private function updateFormasAcesso(Curso $curso, CursoRequest $request)
    {
        $formasAcesso = $request->formas_acesso ?? [];

        $curso->formasAcesso()->delete();

        foreach ($formasAcesso as $formaAcesso) {
            $percent = null;

            if ($formaAcesso == "Vestibular") {
                $percent = $request->vestibular_percent;
            } elseif ($formaAcesso == "SISU") {
                $percent = $request->sisu_percent;
            }

            $curso->formasAcesso()->create([
                'forma_acesso' => $formaAcesso,
                'porcentagem_vagas' => $percent,
            ]);
        }
    }

    public function destroy(string $id)
    {
        $curso =  Curso::findOrFail($id);

        if (!$curso) {
            return back()->with('error', 'Curso não encontrado');
        }

        $atoAutorizacao = $curso->atoAutorizacao;

        if ($atoAutorizacao) {
            $path = storage_path('app/public/' . $atoAutorizacao->path);

            if (File::exists($path)) {
                File::delete($path);
                $curso->atoAutorizacao()->delete();
            }
        }
        $path = storage_path('app/public/' . $curso->calendario);
        if (File::exists($path)) {
            File::delete($path);
        }
        $path = storage_path('app/public/' . $curso->horario);
        if (File::exists($path)) {
            File::delete($path);
        }
        $curso->formasAcesso()->delete();
        $curso->delete();
        return back()->with('success', 'Curso excluído com sucesso');
    }

    public function deleteCalendario($id)
    {
        $curso = Curso::findOrFail($id);

        if (File::exists(storage_path('app/public/' . $curso->calendario))) {
            File::delete(storage_path('app/public/' . $curso->calendario));
            $curso->calendario = null;
            $curso->save();
        }

        return redirect()->back();
    }

    public function deleteHorario($id)
    {
        $curso = Curso::findOrFail($id);

        if (File::exists(storage_path('app/public/' . $curso->horario))) {
            File::delete(storage_path('app/public/' . $curso->horario));
            $curso->horario = null;
            $curso->save();
        }

        return redirect()->back();
    }

    public function deleteAtoAutorizacao($id)
    {
        $curso = Curso::findOrFail($id);

        if (File::exists(storage_path('app/public/' . $curso->atoAutorizacao->path))) {
            File::delete(storage_path('app/public/' . $curso->atoAutorizacao->path));
            $curso->atoAutorizacao()->delete();
            $curso->save();
        }

        return redirect()->back();
    }

    public function downloadCalendario($id)
    {
        $curso =  Curso::findOrFail($id);
        $file = storage_path('app/public/' . $curso->calendario);

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'filename.pdf', $headers);
    }

    public function downloadHorario($id)
    {
        $curso = Curso::findOrFail($id);
        $file = storage_path('app/public/' . $curso->horario);

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'filename.pdf', $headers);
    }

    public function coordenador($id)
    {
        $coordenador = Coordenador::where('curso_id', '=', $id)->first();

        return view('curso.coordenador', compact('coordenador', 'id'));
    }

    public function coordenadorStore(Request $request, $id)
    {
        $coordenador = Coordenador::where('curso_id', '=', $id)->first();

        if ($coordenador) {
            if ($request->professor_id != $coordenador->professor_id) {
                $professor = Professor::find($request->professor_id);

                $coordenador->professor->servidor->user->removeRole('coordenador');

                $professor->servidor->user->syncRoles(['coordenador', 'professor']);
            }

            $coordenador->update([
                'email_contato' => $request->email_contato,
                'horario_atendimento' => $request->horario_atendimento,
                'sala_atendimento' => $request->sala_atendimento,
                'professor_id' => $request->professor_id,
            ]);
        } else {
            $coordenador = Coordenador::create([
                'email_contato' => $request->email_contato,
                'horario_atendimento' => $request->horario_atendimento,
                'sala_atendimento' => $request->sala_atendimento,
                'professor_id' => $request->professor_id,
                'curso_id' => $id,
            ]);

            $coordenador->professor->servidor->user->assignRole('coordenador');
        }

        return redirect('curso')->with('success', 'Coordenado definido com sucesso');
    }

    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscaProfessor(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table("professor")
                ->select("professor.id", "servidor.nome")
                ->join('servidor', 'professor.servidor_id', '=', 'servidor.id')
                ->where('nome', 'LIKE', "%$search%")
                ->get();
        }

        return response()->json($data);
    }

    public function show($id)
    {
        $curso = Curso::findOrFail($id);
        return view('curso.show', ['curso' => $curso]);
    }

    public function sobre()
    {
        $curso = Curso::first();
        return view('curso.show', ['curso' => $curso]);
    }
}
