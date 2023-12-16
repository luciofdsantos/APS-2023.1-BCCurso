

@extends('layouts.main')
@section('title', 'Professor')
@section('content')

<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-chalkboard-teacher fa-2x"></i>
            <h3 class="smaller-font">Professor</h3>
        </div>
    </div>
</div>

<div class="container container-prof">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">

                            @if($professor->foto)
                            <img src="{{ URL::asset('storage') }}/{{ $professor->foto }}" width="90%" class="rounded-image">
                            @else
                            <img src="{{ asset('images/professor/professor_placeholder.png') }}" width="90%" class="rounded-image">
                            @endif
                            <div class="mt-3">
                                <h4 class="text-wrap">{{ $servidor->nome }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nome:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $servidor->nome }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Titulação:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $professor->titulacao }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">E-mail:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            {{ $servidor->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Links:</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                @foreach ($curriculos as $curriculo)
                                    <a href="{{$curriculo->link}}" target="_blank">{{ $curriculo->link }}</a><br>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Área de Atuação: </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                
                                {{ $user->area }} <br>
                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Biografia: </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $professor->biografia }}
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
@stop