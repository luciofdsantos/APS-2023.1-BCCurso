@extends('layouts.main')

@section('title', 'Gerenciar Coordenador')

@section('content')

    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h3 class="smaller-font">Gerenciar Coordenador</h3>
            </div>
        </div>
    </div>
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <form method="post" enctype="multipart/form-data" action="{{ route('curso.coordenador-store', ['id' => $id]) }}">
            @csrf
            <div class="form-group">
                <label for="horario_atendimento" class="form-label"><br>Horário de Atendimento</label>
                <input value="{{ isset($coordenador) ? $coordenador['horario_atendimento'] : '' }}" type="text"
                    name="horario_atendimento" class="form-control" placeholder="Horário" required>
            </div>

            <div class="form-group">
                <label for="email_contato" class="form-label"><br>Email de Contato</label>
                <input value="{{ isset($coordenador) ? $coordenador['email_contato'] : '' }}" type="text"
                    name="email_contato" class="form-control" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label for="sala_atendimento" class="form-label"><br>Sala para Atendimento</label>
                <input value="{{ isset($coordenador) ? $coordenador['sala_atendimento'] : '' }}" type="text"
                    name="sala_atendimento" class="form-control" placeholder="Sala" required>
            </div>

            <div class="form-group">
                <label for="professor_id" class="form-label">Professor: </label>
                @if (isset($coordenador))
                    <select class="form-control" name="professor_id" id="professor_id">
                        <option value="{{ $coordenador->professor_id }}" selected>
                            {{ $coordenador->professor->servidor->nome }}
                        </option>
                    </select>
                @else
                    <select name="professor_id" id="professor_id" class="form-select"></select>
                @endif
            </div>

            <button type="submit" class="btn custom-button btn-default">Cadastrar</button>
            <a href="{{ route('curso.index') }}"
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </form>
    </div>

    <script type="text/javascript">
        $('#professor_id').select2({
            placeholder: 'Busque o professor pelo nome',
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
                url: '/curso/busca-professor',
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

@stop
