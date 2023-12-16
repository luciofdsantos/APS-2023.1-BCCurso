<?php

namespace App\Http\Controllers;

use App\Http\Requests\AtaRequest;
use App\Models\Ata;
use App\Models\Colegiado;
use Illuminate\Http\Request;

class AtaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colegiados = Colegiado::orderBy('numero_portaria')
            ->get();
        $hoje = date(now());
        return view('ata.create', ['hoje' => $hoje,'colegiados' => $colegiados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtaRequest $request)
    {
        $colegiado = Colegiado::find($request->colegiado);

        if($colegiado) {
            $ata = new Ata([
                'data' => $request->data,
                'descricao' => $request->descricao
            ]);

            $colegiado->atas()->save($ata);
            return redirect('colegiado')->with('success', 'Ata cadastrada com sucesso!');
        } else {
            return redirect('colegiado')->with('success', 'Não há colegiado vigente!');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ata = Ata::findOrFail($id);

        return view('ata.view', ['ata' => $ata]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ata = Ata::findOrFail($id);
        $colegiadoPertence = $ata->colegiado;

        $colegiados = Colegiado::orderBy('numero_portaria', 'asc')
            ->get();
        return view('ata.edit', ['ata' => $ata, 'colegiados' => $colegiados, 'colegiadoPertencente' => $colegiadoPertence]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtaRequest $request, string $id)
    {
        $ata = Ata::findOrFail($id);
        $colegiado = Colegiado::find($request->colegiado);

        $ata->update([
            'data' => $request->data,
            'descricao' => $request->descricao,
            'colegiado_id' => $colegiado->id
        ]);

        return redirect('colegiado')->with('success', 'Ata atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ata = Ata::findOrFail($id);
        $ata->delete();
        return back()->with('success', 'Ata excluída com sucesso');
    }
}
