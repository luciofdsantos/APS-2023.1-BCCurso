<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostagemRequest;
use App\Models\Aluno;
use App\Models\ArquivoPostagem;
use App\Models\Banca;
use App\Models\ImagemPostagem;
use App\Models\Postagem;
use App\Models\Professor;
use App\Models\TipoPostagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        if ($buscar) {
            $postagens = Postagem::where('titulo', 'like', '%' . $buscar . '%')->get();
        } else {
            $postagens = Postagem::all();
        }

        return view('postagem.index', ['postagens' => $postagens, 'buscar' => $buscar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipo_postagens = TipoPostagem::pluck('nome', 'id');

        $id = 1;

        if (old() && URL::previous() == route('tcc.create')) {
            $banca = Banca::findOrFail(old('banca_id'));
            $professor = Professor::findOrFail(old('professor_id'));
            $aluno = Aluno::findOrFail(old('aluno_id'));

            $postagem = [
                'titulo' => 'Convite TCC',
                'texto' =>
                'Aluno: ' . $aluno->nome . "\n" .
                    'Título: ' . old('titulo') . "\n" .
                    'Orientador: ' . $professor->servidor->nome . "\n" .
                    'Data: ' . date('d/m/Y', strtotime($banca->data)) . "\n" .
                    'Local: ' . $banca->local
            ];

            return view('postagem.create', compact('tipo_postagens', 'id', 'postagem'));
        }

        return view('postagem.create', compact('tipo_postagens', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostagemRequest $request)
    {
        $postagem = new Postagem([
            'titulo' => $request->titulo,
            'texto' => $request->texto,
            'tipo_postagem_id' => $request->tipo_postagem_id,
            'menu_inicial' => $request->has('menu_inicial')
        ]);

        $exibirMenuInicial = $request->has('menu_inicial');
        
        if ($exibirMenuInicial) {
            if ($request->hasFile("imagens")) {

                $imagens = $request->file("imagens");
                $validacao = true; 
                $dimensions = getimagesize($imagens[0]);
                $largura = $dimensions[0];
                $altura = $dimensions[1];

                if ($largura !== 2700 || $altura !== 660) {
                    $validacao = false;
                }

                if (!$validacao) {
                    return redirect()->back()->withInput()->with('error', 'A primeira imagem para exibição no menu inicial deve ter as dimensões de 2700 x 660.');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Foi solicitado que aparecesse na tela inicial com destaque, mas não teve uma imagem cadastrada.');
            }
        }

        $postagem->save();

        if ($request->hasFile("imagens")) {
            $imagens = $request->file("imagens");

            foreach ($imagens as $imagem) {
                $imagemPostagem = new ImagemPostagem();
                $imagemPostagem->postagem_id = $postagem->id;
                $imagemPostagem->imagem = $imagem->store('ImagemPostagem/' . $postagem->id);
                $imagemPostagem->save();
                unset($imagemPostagem);
            }
        }

        if ($request->hasFile("arquivos")) {
            $arquivos = $request->file("arquivos");

            foreach ($arquivos as $arquivo) {
                $arquivoPostagem = new ArquivoPostagem();
                $arquivoPostagem->postagem_id = $postagem->id;
                $arquivoPostagem->nome = $arquivo->getClientOriginalName();
                $arquivoPostagem->path = $arquivo->store('ArquivoPostagem/' . $postagem->id);
                $arquivoPostagem->save();
                unset($arquivoPostagem);
            }
        }

        return redirect('postagem')->with('success', 'Postagem Criada com Sucesso');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postagem =  Postagem::findOrFail($id);
        $tipo_postagens = TipoPostagem::pluck('nome', 'id');

        return view('postagem.edit', ['postagem' => $postagem, 'tipo_postagens' => $tipo_postagens]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostagemRequest $request, string $id)
    {
        $postagem =  Postagem::findOrFail($id);

        $postagem->update([
            'titulo' => $request->titulo,
            'texto' => $request->texto,
            'tipo_postagem_id' => $request->tipo_postagem_id,
            'menu_inicial' => $request->has('menu_inicial')
        ]);

        if ($request->hasFile("imagens")) {
            $imagens = $request->file("imagens");

            foreach ($imagens as $imagem) {
                $imagemPostagem = new ImagemPostagem();
                $imagemPostagem->postagem_id = $postagem->id;
                $imagemPostagem->imagem = $imagem->store('ImagemPostagem/' . $postagem->id);
                $imagemPostagem->save();
                unset($imagemPostagem);
            }
        }

        if ($request->hasFile("arquivos")) {
            $arquivos = $request->file("arquivos");

            foreach ($arquivos as $arquivo) {
                $arquivoPostagem = new ArquivoPostagem();
                $arquivoPostagem->postagem_id = $postagem->id;
                $arquivoPostagem->nome = $arquivo->getClientOriginalName();
                $arquivoPostagem->path = $arquivo->store('ArquivoPostagem/' . $postagem->id);
                $arquivoPostagem->save();
                unset($arquivoPostagem);
            }
        }

        return redirect('postagem')->with('success', 'Postagem Alterada com Sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postagem =  Postagem::findOrFail($id);
        $postagem->delete();
        return back()->with('success', 'Postagem Excluída com Sucesso');
    }

    public function deleteImagem($id)
    {
        $imagem = ImagemPostagem::findOrFail($id);

        if (File::exists("storage/"  . $imagem->imagem)) {
            File::delete("storage/"  . $imagem->imagem);
        }
        $imagem->delete();
        return back();
    }

    public function deleteArquivo($id)
    {
        $arquivo = ArquivoPostagem::findOrFail($id);

        if (File::exists("storage/"  . $arquivo->path)) {
            File::delete("storage/"  . $arquivo->path);
        }
        $arquivo->delete();
        return back();
    }

    public function display()
    {
        $postagens = Postagem::orderBy('created_at', 'desc')->get();
        $postagens_9 = Postagem::orderBy('created_at', 'desc')->paginate(9);
        
        return view('postagem.display', ['postagens' => $postagens, 'postagens_9' => $postagens_9]);
    }

    public function show(string $id)
    {
        $postagem =  Postagem::findOrFail($id);
        $tipo_postagem = TipoPostagem::findOrFail($postagem->tipo_postagem_id);
        return view('postagem.show', ['postagem' => $postagem, 'tipo_postagem' => $tipo_postagem]);
    }
}
