@extends('layouts.main')

@section('title', 'Editar Professor')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-person-chalkboard fa-2x"></i>
                <h3 class="smaller-font">Editar Professor</h3>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <form method="post" action="{{ route('professor.update', ['id' => $servidor->id]) }}">
            @csrf
            @method('PUT')
            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="nome">Nome*:</label>
                    <input value="{{ $servidor->nome }}" class="form-control" id="nome" name="nome" type="text"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email*:</label>
                    <input value="{{ $servidor->email }}" class="form-control" id="email" name="email" type="email"
                        required>
                </div>

                <button type="submit" class="btn custom-button btn-default">Salvar</button>
                <a href="{{ route('professor.index') }} "
                    class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>

            </form>
        </form>
    </div>
@stop
