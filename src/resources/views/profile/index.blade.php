@extends('layouts.main')
<!--NÃO USADO-->
@section('title', 'Professores')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-paste fa-2x"></i>
                <h3 class="smaller-font">Lista de Professores</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row campo-busca">
            <div class="col-md-12">
                <input type="text" id="searchInput" class="form-control field-search" placeholder="Buscar em todos os campos"
                    aria-label="Buscar">
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-white div-form">
                            Professores
                        </div>
                        <div class="card-body">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Currículo Lattes</th>
                                        <th>Titulação</th>
                                        <th>Biografia</th>
                                        <th>Área</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->curriculo_lattes }}</td>
                                            <td>{{ $user->titulacao }}</td>
                                            <td>{{ $user->biografia }}</td>
                                            <td>{{ $user->area }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
