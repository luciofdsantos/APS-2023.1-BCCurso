@extends('layouts.main')

@section('title', 'Definir Coordenador')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-envelopes-bulk fa-2x"></i>
                <h3 class="smaller-font">Definir Coordenador</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="post" action="{{ route('coordenador.update', ['id' => $coordenador->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Horário de Atendimento</label>
                <textarea name="horario_atendimento" id="descricao" class="form-control" required>{{ $coordenador->horario_atendimento }}</textarea>
            </div>

            <div class="form-group">
                <label for="titulo">E-mail para contato</label>
                <input value="{{ $coordenador->email }}" type="text" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="titulo">Sala para Atendimento</label>
                <input value="{{ $coordenador->sala_atendimento }}" type="text" name="sala_atendimento" class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label for="professor_id">Professor Responsável</label>
                <select class="form-control" name="professor_id" id="professor_id">
                    <option value="{{ $coordenador->professor_id }}" selected>
                        {{ $coordenador->professor->servidor->nome }}
                    </option>
                </select>
            </div>

            <div class="col-md-3 mb-3 d-flex align-items-end">
                <a href="" class="btn custom-button modal-trigger" data-bs-toggle="modal"
                    data-bs-target="#createProfessor">Cadastrar professor</a>
            </div>
            @include('modal.createProfessor')

            <button type="submit" class="btn custom-button btn-default">Salvar</button>
            <button class="btn custom-button custom-button-castastrar-tcc btn-default"><a
                    href="{{ route('projeto.index') }} "class="btn-back">Cancelar</a></button>

        </form>

        <script type="text/javascript">
            $('#professor_id').select2({
                placeholder: 'Selecione o professor',
                ajax: {
                    url: '/coordenador/busca-professor',
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
