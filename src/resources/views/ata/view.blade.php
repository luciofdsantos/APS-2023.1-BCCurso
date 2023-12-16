@extends('layouts.main')
@section('title', 'Ata')
@section('content')

<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Ata</h3>
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
                            <h6 class="mb-0">Data da Ata:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ date('d/m/Y', strtotime($ata->data)) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Descrição:</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $ata->descricao }}
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
