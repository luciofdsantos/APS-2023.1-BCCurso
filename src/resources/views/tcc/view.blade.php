@extends('layouts.main')
@section('title', 'TCC')
@section('content')

<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-graduation-cap fa-2x"></i>
            <h3 class="smaller-font">TCC</h3>
        </div>
    </div>
</div>

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
                            {{$tcc->titulo}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Ano:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$tcc->ano}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Resumo:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {!! nl2br(str_replace(' ', '&nbsp;', e($tcc->resumo))) !!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Aluno:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$aluno->nome}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Orientador:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$orientador->nome}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Local da Banca:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{$banca->local}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Data da Banca:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ date('d/m/Y', strtotime($banca->data)) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Professores Banca: </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">

                            @if (count($banca->professoresExternos) > 0)
                            <span style="font-weight: bold;"> Professores Externos:</span><br>
                            @foreach ($banca->professoresExternos as $professor_externo)
                            <span>{{ $professor_externo->nome }} - {{ $professor_externo->filiacao }}
                            </span><br>
                            @endforeach
                            <br>
                            @endif

                            @if (count($banca->professores) > 0)
                            <span style="font-weight: bold;"> Professores Internos:</span><br>
                            @foreach ($banca->professores as $professor)
                            <span>{{ $professores_internos->contains($professor->id) ? $professores_internos->where('id', $professor->id)->first()->nome: '' }} </span>
                            <span>{!! $professores_internos->contains($professor->id) ? '<br>' : '' !!}</span>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Status: </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $tcc->status == 0 ? "Aguardando defesa" : "Concluido"}}
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Arquivo: </h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($tcc->arquivo)

                            <a href="{{ URL::asset('storage') }}/{{ $tcc->arquivo->path }}" download>{{ $tcc->arquivo->nome }}</a>

                            @else
                            Não há arquivo cadastrado!
                            @endif
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

@stop