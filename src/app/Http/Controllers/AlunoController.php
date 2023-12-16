<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function store(Request $request)
    {
        $aluno = new Aluno;

        $aluno->nome = $request->nome;
        $aluno->save();

        if ($request->contexto != 'modal') {
            return redirect('/aluno')->with('success', 'Aluno cadastrado com sucesso');
        } else {
            $alunos = Aluno::all();
            return response()->json(['alunos' => $alunos]);
        }
    }

}
