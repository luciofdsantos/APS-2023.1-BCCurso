@extends('layouts.main')
@section('title', 'Banca')
@section('content')

<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Banca</h3>
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
                            <h6 class="mb-0">Data da Banca:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ date('d/m/Y', strtotime($banca->data)) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Local da Banca:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $banca->local }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Professores Internos:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $banca->presidente->servidor->nome }} <br>
                            @foreach ($banca->professores as $professor)
                            <span>{{ $professores_internos->contains($professor->id) ? $professores_internos->where('id', $professor->id)->first()->nome : '' }} </span>
                            <span>{!! $professores_internos->contains($professor->id) ? '<br>' : '' !!}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Professores Externos:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @foreach ($banca->professoresExternos as $professor_externo)
                            <span>{{ $professor_externo->nome }} - {{ $professor_externo->filiacao }}</span><br>
                            @endforeach
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
