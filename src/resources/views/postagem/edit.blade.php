@extends('layouts.main')

@section('title', 'Editar Postagem')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-pen-to-square fa-2x"></i>
                <h3 class="smaller-font" class="form-label">Editar Postagem</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="post" action="{{ route('postagem.update', ['id' => $postagem->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titulo" class="form-label"><br>Título*:</label>
                <input type="text" value="{{ old('titulo') ?? $postagem->titulo }}" name="titulo" id="titulo"
                    required class="form-control @error('titulo') is-invalid @enderror" placeholder="Título da postagem">

                @error('titulo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="texto" class="form-label">Texto*:</label>
                <textarea name="texto" id="texto" class="form-control @error('texto') is-invalid @enderror"
                    placeholder="Texto da postagem" required>{{ old('texto') ?? $postagem->texto }}</textarea>
                @error('texto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_postagem" class="form-label">Tipo*:</label>
                <select name="tipo_postagem_id" id="tipo_postagem_id"
                    class="form-control @error('tipo_postagem_id') is-invalid @enderror" required>
                    @foreach ($tipo_postagens as $key => $value)
                        <option value="{{ $key }}" {{ $key == $postagem->tipo_postagem_id ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>

                @error('tipo_postagem_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_postagem" class="form-label">Exibir na tela inicial com destaque? (necessário cadastrar imagem)</label>
                <input type="checkbox" name="menu_inicial" id="menu_inicial" {{ $postagem->menu_inicial ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="imagem" class="form-label">Imagens (caso for exibir na tela inicial, a primeira imagem deve ter a dimensão: 2700 x 660):</label>
                @if (count($postagem->imagens) > 0)
                    @foreach ($postagem->imagens as $img)
                        <button class="btn text-danger" type="submit" form="deletar-imagens{{ $img->id }}">X</button>
                        <img src="{{ URL::asset('storage') }}/{{ $img->imagem }}" class="img-responsive"
                            style="max-height:100px; max-width:100px;">
                    @endforeach
                @endif
                <input type="file" name="imagens[]" id="imagens" class="form-control" multiple>
            </div>

            <div class="form-group">
                <label for="arquivo" class="form-label">Arquivos:</label>
                @if (count($postagem->arquivos) > 0)
                    @foreach ($postagem->arquivos as $arquivo)
                        <button class="btn text-danger" type="submit"
                            form="deletar-arquivos{{ $arquivo->id }}">X</button>
                        <a download href="{{ asset('storage') }}/{{ $arquivo->path }}">{{ $arquivo->nome }}</a>
                    @endforeach
                @endif
                <input type="file" name="arquivos[]" id="arquivos" class="form-control" multiple>
            </div>

            <button type="submit" class="btn custom-button btn-default">Salvar</button>
            <a href="{{ route('postagem.index') }} "
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </form>

        @if (count($postagem->imagens) > 0)
            @foreach ($postagem->imagens as $img)
                <form id="deletar-imagens{{ $img->id }}"
                    action="{{ route('postagem.delete_imagem', ['id' => $img->id]) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            @endforeach
        @endif

        @if (count($postagem->arquivos) > 0)
            @foreach ($postagem->arquivos as $arquivo)
                <form id="deletar-arquivos{{ $arquivo->id }}"
                    action="{{ route('postagem.delete_arquivo', ['id' => $arquivo->id]) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
            @endforeach
        @endif
    </div>
@stop
