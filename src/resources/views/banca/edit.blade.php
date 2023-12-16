@extends('layouts.main')

@section('title', 'Editar Banca')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Editar Banca</h3>
        </div>
    </div>
</div>
<div class="container mt-4">
    <form method="post" action="{{ route('banca.update', ['id' => $banca->id]) }}">
        @csrf
        @method('PUT')
        <label for="data" class="form-label">Data da banca*:</label>
        <input type="date" name="data" id="data" class="form-control" value="{{date('Y-m-d', strtotime($banca->data))}}" required>
        <br>
        <label for="local" class="form-label">Local*:</label>
        <input type="text" name="local" id="local" class="form-control" value="{{$banca->local}}" placeholder="Local da banca" required>

        <div class="form-group">
            <label for="" class="form-label"> <br>Presidente*:</label>
            <select name="presidente" id="presidente" class="form-select" required>
                @foreach ($professores_internos as $professor)
                <option value="{{ $professor->id }}" data-professor-id="{{ $professor->id }}"
                    {{ $professor->id == $banca->presidente->id ? 'selected' : '' }}> {{$professor->nome}} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="professores">
            <label for="professores" class="form-label">Professores internos:</label>
            @foreach ($professores_internos as $professor_interno)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="professores_internos[]" id="professor_{{$professor_interno->id}}"
                    value="{{$professor_interno->id}}" {{$banca->professores->contains($professor_interno->id) ? 'checked' : ''}}>
                <label for="professor_{{$professor_interno->id}}" class="form-check-label">{{$professor_interno->nome}} </label>
            </div>
            @endforeach
        </div>
        <a href="" class="btn btn-info modal-trigger" data-bs-toggle="modal" data-bs-target="#createProfessor">Cadastrar professor interno</a>

        <div class="form-group" id="professores_externos">
            <br>
            <label for="professores" class="form-label">Professores externos:</label>
            @foreach ($professores_externos as $professor_externo)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="professores_externos[]" id="professor_externo_{{$professor_externo->id}}" value="{{$professor_externo->id}}" {{$banca->professoresExternos->contains($professor_externo->id) ? 'checked' : ''}}>
                <label for="professor_externo_{{$professor_externo->id}}" class="form-check-label">{{$professor_externo->nome}} - {{$professor_externo->filiacao}}</label>
            </div>
            @endforeach
        </div>
        <a href="" class="btn btn-info modal-trigger" data-bs-toggle="modal" data-bs-target="#createProfessorExterno">Cadastrar professor externo</a>
        <div>
            <button type="submit" class="btn custom-button custom-button-castastrar-tcc btn-default">Salvar</button>
            <a href="{{ route('banca.index') }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </div>
    </form>
</div>
@include('modal.createProfessor')
@include('modal.createProfessorExterno')
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Obtenha o ID do presidente atual
        var presidenteId = $('#presidente').val();

        $('#professor_' + presidenteId).prop('checked', true);
        $('#professor_' + presidenteId).prop('disabled', true);

        $('#presidente').change(function() {
            var novoPresidenteId = $(this).val();

            $('#professor_' + presidenteId).prop('checked', false);
            $('#professor_' + presidenteId).prop('disabled', false);
            $('#professor_' + novoPresidenteId).prop('checked', true);
            $('#professor_' + novoPresidenteId).prop('disabled', true);

            presidenteId = novoPresidenteId;
        });
    });
</script>
