<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AtaController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\ColegiadoController;
use App\Http\Controllers\PostagemController;
use App\Http\Controllers\ProfessorExternoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\TipoPostagemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\TccController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PpcController;
use App\Http\Controllers\CoordenadorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*--------------------------INFORMAÇÕES PÚBLICAS-------------------------------*/

require __DIR__ . '/auth.php';

//Página Inicial
Route::get('/', function () {
    return redirect()->route('postagem.display');
});

// Displays de postagens e professores (Não editável)
Route::get('/noticias', [PostagemController::class, 'display'])->name('postagem.display');
Route::get('/professores', [ProfessorController::class, 'display'])->name('professor.display');

//Banca
Route::get('/banca/show/{id}', [BancaController::class, 'show'])->name('banca.show');

//Ata troca para o user logado
Route::get('/ata/show/{id}', [AtaController::class, 'show'])->name('ata.view');

//Colegiado
Route::get('/colegiados', [ColegiadoController::class, 'show'])->name('colegiado.show');

//Postagem
Route::get('/postagem/show/{id}', [PostagemController::class, 'show'])->name('postagem.show');

//Sobre o curso
Route::get('/curso/sobre', [CursoController::class, 'sobre'])->name('curso.sobre');
Route::get('/curso/show/{id}', [CursoController::class, 'show'])->name('curso.show');

//Coordenador
Route::get('/coordenador/{id}', [CoordenadorController::class, 'view'])->name('coordenador.display');

//TCC
Route::get('/tccs', [TccController::class, 'show'])->name('tcc.display');;
Route::get('/tccs/{id}', [TccController::class, 'view'])->name('tcc.view');
Route::post('/tccs/concluiTcc/{id}', [TccController::class, 'concluiTcc'])->name('tcc.concluiTcc');

//Professor
Route::get('/professores/{id}', [ProfessorController::class, 'view'])->name('professor.view');

//Projeto
Route::get('/projetos', [ProjetoController::class, 'view'])->name('projetos.view');
Route::get('/projeto/show/{id}', [ProjetoController::class, 'show'])->name('projeto.show');

//Servidor
Route::resource('servidor', ServidorController::class)->parameter('servidor', 'id')->except(['show', 'edit', 'update', 'destroy']);




//Informações dos Professores (Não Editável)
//Route::resource('/professores/info', ProfileController::class)->parameter('user', 'id')->except(['show']);

/*--------------INFORMAÇÕES PRIVADAS (NECESSÁRIO REGISTRO E LOGIN)-------------*/

//Landing Page (Após login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//CRUDs
Route::middleware('auth', 'role:professor')->group(function () {

    //Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/delete_foto/{id}', [ProfileController::class, 'deleteFoto'])->name('profile.delete_foto');
});

Route::middleware('auth', 'role:coordenador')->group(function () {

    // TipoPostagem
    Route::resource('tipo-postagem', TipoPostagemController::class)->parameter('tipo-postagem', 'id')->except(['show']);

    // Postagem
    Route::resource('postagem', PostagemController::class)->parameter('postagem', 'id')->except(['show']);

    Route::delete('/postagem/delete_imagem/{id}', [PostagemController::class, 'deleteImagem'])->name('postagem.delete_imagem');
    Route::delete('/postagem/delete_arquivo/{id}', [PostagemController::class, 'deleteArquivo'])->name('postagem.delete_arquivo');

    //Banca
    Route::resource('banca', BancaController::class)->parameter('banca', 'id')->except(['show']);

    // TCC
    Route::resource('tcc', TccController::class)->parameter('tcc', 'id')->except(['show']);

    // Projeto
    Route::resource('projeto', ProjetoController::class)->parameter('projeto', 'id')->except(['show']);
    Route::get('/projeto/busca-professor', [ProjetoController::class, 'buscaProfessor']);
    Route::get('/projeto/busca-aluno', [ProjetoController::class, 'buscaAluno']);
    Route::get('/projeto/busca-professor-externo', [ProjetoController::class, 'buscaProfessorExterno']);
    Route::delete('/projeto/delete_imagem/{id}', [ProjetoController::class, 'deleteImagem'])->name('projeto.delete_imagem');

    // Professor
    Route::resource('professor', ProfessorController::class)->parameter('professor', 'id');

    // Colegiado
    Route::resource('colegiado', ColegiadoController::class)->parameter('colegiado', 'id')
        ->except(['show']);

    // Ata
    Route::resource('ata', AtaController::class)->parameter('ata', 'id')->except(['index']);

    //Aluno
    Route::resource('aluno', AlunoController::class)->parameter('aluno', 'id')->only(['store']);

    //Professor Externo
    Route::resource('professor-externo', ProfessorExternoController::class)->parameter('professor-externo', 'id')
        ->only(['index', 'store', 'create']);

    // Curso
    Route::resource('curso', CursoController::class)->parameter('curso', 'id')->except(['show']);

    Route::delete('/curso/delete_atoAutorizacao/{id}', [CursoController::class, 'deleteAtoAutorizacao'])->name('curso.delete_atoAutorizacao');

    Route::delete('/curso/delete_calendario/{id}', [CursoController::class, 'deleteCalendario'])->name('curso.delete_calendario');

    Route::delete('/curso/delete_horario/{id}', [CursoController::class, 'deleteHorario'])->name('curso.delete_horario');

    Route::get('/curso/calendario/{id}', [CursoController::class, 'downloadCalendario'])->name('curso.download_calendario');

    Route::get('/curso/horario/{id}', [CursoController::class, 'downloadHorario'])->name('curso.download_horario');

    Route::get('/curso/coordenador/{id}', [CursoController::class, 'coordenador'])->name('curso.coordenador');

    Route::post('/curso/coordenador-store/{id}', [CursoController::class, 'coordenadorStore'])->name('curso.coordenador-store');

    Route::get('/curso/busca-professor', [CursoController::class, 'buscaProfessor']);

    Route::prefix('/curso/{cursoId}')->group(function () {
        Route::resource('/ppc', PpcController::class)->except(['show']);
    });

});
