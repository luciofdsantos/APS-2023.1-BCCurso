@extends('layouts.main')

@section('title', 'Criar Projeto')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-envelopes-bulk fa-2x"></i>
                <h3 class="smaller-font">Cadastro de Projeto</h3>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <form method="post" action="{{ route('projeto.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo" class="form-label">Título*: </label>
                <textarea name="titulo" id="titulo" placeholder="Título do projeto" required
                    class="form-control @error('titulo') is-invalid @enderror">{{ old('titulo') }}</textarea>
                
                
                @error('titulo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descricao" class="form-label">Descrição*: </label>
                <textarea name="descricao" id="descricao" placeholder="Descrição do projeto" required
                    class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>
                
                
                    @error('descricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="data_inicio" class="form-label">Data de Início*: </label>
                <input type="date" name="data_inicio" id="data_inicio" value="{{ old('data_inicio') }}"
                    class="form-control @error('data_inicio') is-invalid @enderror" required>
                
                
                @error('data_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            

            <div class="form-group">
                <label for="data_termino" class="form-label">Data de Termino: </label>
                <input type="date" name="data_termino" id="data_termino" value="{{ old('data_termino') }}"
                    class="form-control @error('data_termino') is-invalid @enderror">
                
                
                @error('data_termino')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="resultados" class="form-label">Resultados: </label>
                <input type="text" name="resultados" id="resultados" value="{{ old('resultados') }}"
                    class="form-control @error('resultados') is-invalid @enderror" placeholder="Resultados do projeto">
                
                
                @error('resultados')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagens" class="form-label">Imagens:</label>
                <input type="file" name="imagens[]" id="imagens"
                    class="form-control @error('imagens.*') is-invalid @enderror" multiple>

                @error('imagens.*')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="palavras_chave" class="form-label">Palavras-Chave*:</label>
                <input type="text" name="palavras_chave" id="palavras_chave" value="{{ old('palavras_chave') }}"
                    class="form-control @error('palavras_chave') is-invalid @enderror" placeholder="Palavras Chave">
                
                
                    @error('palavras_chave')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="fomento" class="form-label">Fomento:</label>
                <input type="text" name="fomento" id="fomento" value="{{ old('fomento') }}"
                    class="form-control @error('fomento') is-invalid @enderror" placeholder="Fomento">

                @error('fomento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="link" class="form-label">Link:</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}"
                    class="form-control @error('link') is-invalid @enderror" placeholder="Link">

                @error('link')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="professor_id" class="form-label">Professor Responsável*: </label>
                <select name="professor_id" id="professor_id"
                    class="form-select @error('professor_id') is-invalid @enderror"></select>
                
                
                    @error('professor_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="professores" class="form-label">Professores Colaboradores:</label>
                <select class="form-select" name="professores[]" id="professores" multiple></select>
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end">
                <a href="" class="btn custom-button modal-trigger" data-bs-toggle="modal"
                    data-bs-target="#createProfessor">Cadastrar professor</a>
            </div>

            <div class="form-group">
                <label for="professores_externos" class="form-label">Professores Externos:</label>
                <select class="form-select" name="professores_externos[]" id="professores_externos" multiple></select>
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end">
                <a href="" class="btn custom-button modal-trigger" data-bs-toggle="modal"
                    data-bs-target="#createProfessorExterno">Cadastrar professor Externo</a>
            </div>

            <div class="form-group">
                <label for="alunos_bolsistas" class="form-label">Alunos Bolsistas:</label>
                <select class="form-select" name="alunos_bolsistas[]" id="alunos_bolsistas" multiple></select>
            </div>

            <div class="form-group">
                <label for="aluno_id" class="form-label">Alunos Voluntários:</label>
                <select class="form-select" name="alunos_voluntarios[]" id="alunos_voluntarios" multiple></select>
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end">
                <a href="" class="btn custom-button modal-trigger" data-bs-toggle="modal"
                    data-bs-target="#createAluno">Cadastrar aluno</a>
            </div>


            <button type="submit" class="btn custom-button btn-default">Cadastrar</button>
            <a href="{{ route('projeto.index') }} "
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>

        </form>

        @include('modal.createProfessor')
        @include('modal.createAluno')
        @include('modal.createProfessorExterno')

        <script type="text/javascript">
            $('#professor_id, #professores').select2({
                placeholder: 'Selecione o professor responsável',
                language: {
                    noResults: function() {
                        return "Resultados não encontrados";
                    },
                    inputTooShort: function() {
                        return "Digite 1 ou mais caracteres";
                    }
                },
                minimumInputLength: 1,
                ajax: {
                    url: '/projeto/busca-professor',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nome,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#alunos_bolsistas, #alunos_voluntarios').select2({
                placeholder: 'Selecione um aluno para o projeto',
                language: {
                    noResults: function() {
                        return "Resultados não encontrados";
                    },
                    inputTooShort: function() {
                        return "Digite 1 ou mais caracteres";
                    }
                },
                minimumInputLength: 1,
                ajax: {
                    url: '/projeto/busca-aluno',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nome,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#professores_externos').select2({
                placeholder: 'Selecione os professores externos participantes',
                language: {
                    noResults: function() {
                        return "Resultados não encontrados";
                    },
                    inputTooShort: function() {
                        return "Digite 1 ou mais caracteres";
                    }
                },
                minimumInputLength: 1,
                ajax: {
                    url: '/projeto/busca-professor-externo',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nome,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        </script>
    </div>
@stop
