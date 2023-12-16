@extends('layouts.main')

@section('title', 'Cadastrar Professor')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-person-chalkboard fa-2x"></i>
                <h3 class="smaller-font">Cadastrar Professor</h3>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <form method="post" action="{{ route('professor.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nome">Nome*:</label>
                <input class="form-control" id="nome" name="nome" type="text" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email*:</label>
                <input class="form-control" id="email" name="email" type="email" required>
            </div>
            <button type="submit" class="btn custom-button btn-default">Cadastrar</button>
            <a href="{{ route('professor.index') }} "
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </form>
    </div>
@stop
