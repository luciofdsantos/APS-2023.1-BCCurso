<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoPostagemRequest;
use App\Models\TipoPostagem;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TipoPostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        if ($buscar) {
            $tipo_postagens = TipoPostagem::where('nome', 'like', '%' . $buscar . '%')->get();
        } else {
            $tipo_postagens = TipoPostagem::all();
        }

        return view('tipo-postagem.index', ['tipo_postagens' => $tipo_postagens, 'buscar' => $buscar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo-postagem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipoPostagemRequest $request)
    {
        TipoPostagem::create([
            'nome' => $request->nome
        ]);

        return redirect('tipo-postagem')->with('success', 'Tipo de Postagem Criado com Sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipo_postagem =  TipoPostagem::findOrFail($id);
        return view('tipo-postagem.edit', ['tipo_postagem' => $tipo_postagem]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipoPostagemRequest $request, string $id)
    {
        $tipo_postagem =  TipoPostagem::findOrFail($id);

        $tipo_postagem->update([
            'nome' => $request->nome
        ]);

        return redirect('tipo-postagem')->with('success', 'Tipo de Postagem Alterado com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tipo_postagem =  TipoPostagem::findOrFail($id);
            $tipo_postagem->delete();
            $tipo = "success";
            $mensagem = "Tipo de Postagem Excluido com Sucesso!";
        } catch(QueryException){
            $tipo = "error";
            $mensagem = "Tipo de Postagem utilizado no sistema!";
        }

        return back()->with($tipo, $mensagem);
    }
}
