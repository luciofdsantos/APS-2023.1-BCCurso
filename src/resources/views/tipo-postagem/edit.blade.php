@extends('layouts.main')

@section('title', 'Editar Tipo de Postagem')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-paste fa-2x"></i>
                <h3 class="smaller-font">Editar Tipo Postagem</h3>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <form method="post" action="{{ route('tipo-postagem.update', ['id' => $tipo_postagem->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome" class="form-label">Nome*:</label>
                <input value="{{ old('nome') ?? $tipo_postagem->nome }}" type="text" name="nome" id="nome"
                    placeholder="Nome do tipo de postagem" required
                    class="form-control @error('nome') is-invalid @enderror">

                @error('nome')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn custom-button btn-default">Salvar</button>
            <a href="{{ route('tipo-postagem.index') }} "
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </form>
    </div>
@stop
