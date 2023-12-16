@extends('layouts.main')
@section('title', 'Projeto')
@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-envelopes-bulk fa-2x"></i>
                <h3 class="smaller-font">Projeto</h3>
            </div>
        </div>
    </div>
    <br>

    <div class="container mt-5">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-sm-3">
                                <h6 class="mb-0">Título:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->titulo }}
                            </div>
                        </div>

                        <hr>


                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Descrição:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->descricao }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Data de Início:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ date('d/m/Y', strtotime($projeto->data_inicio)) }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Data de Término:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->data_termino ? date('d/m/Y', strtotime($projeto->data_termino)) : 'Não definido' }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Coordenador:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->professor->servidor->nome }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Professores Colaboradores:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                                @if (count($projeto->professoresColaboradores) > 0)

                                    @foreach ($projeto->professoresColaboradores as $key => $profColab)
                                        <span> {{ $profColab->servidor->nome }}@if ($key < count($projeto->professoresColaboradores) - 1)
                                            , @else.
                                            @endif </span>
                                    @endforeach
                                    <br>

                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Professores Externos:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                                @if (count($projeto->professoresExternos) > 0)

                                    @foreach ($projeto->professoresExternos as $key => $profExterno)
                                        <span> {{ $profExterno->nome }}@if ($key < count($projeto->professoresExternos) - 1)
                                            , @else.
                                            @endif </span>
                                    @endforeach
                                    <br>

                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alunos Bolsistas:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                                @if (count($projeto->alunosBolsistas) > 0)
                                    @foreach ($projeto->alunosBolsistas as $key => $alunoBolsista)
                                        <span> {{ $alunoBolsista->nome }}@if ($key < count($projeto->alunosBolsistas) - 1)
                                            , @else.
                                            @endif </span>
                                    @endforeach
                                    <br>
                                @endif

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Alunos Voluntários:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">

                                @if (count($projeto->alunosVoluntarios) > 0)
                                    @foreach ($projeto->alunosVoluntarios as $key => $alunoVoluntario)
                                        <span> {{ $alunoVoluntario->nome }}@if ($key < count($projeto->alunosVoluntarios) - 1)
                                            , @else.
                                            @endif </span>
                                    @endforeach
                                    <br>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Resultados:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->resultados }}
                            </div>
                        </div>

                        <hr>


                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Fomento:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->fomento }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Página:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $projeto->link }}
                            </div>

                            <hr>

                            <div class="row">

                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">

                                    @if (count($projeto->imagens) > 0)

                                        @foreach ($projeto->imagens as $img)
                                            <a href="{{ URL::asset('storage') }}/{{ $img->imagem }}"
                                                target="{{ URL::asset('storage') }}/{{ $img->imagem }}"><img
                                                    src="{{ URL::asset('storage') }}/{{ $img->imagem }}"
                                                    class="img-responsive" style="max-height:100px; max-width:100px;"></a>
                                        @endforeach
                                        <br>

                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url()->previous() }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Voltar</a>
    </div>

@endsection
