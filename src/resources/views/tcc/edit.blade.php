@extends('layouts.main')
@section('title', 'Editar TCC')
@section('content')

    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h3 class="smaller-font">Editar TCC</h3>
            </div>
        </div>
    </div>

    <div class="container mt-4">

        <form method="post" action="{{ route('tcc.update', [$tcc->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label"> <br>Título*:</label>
                <input type="text" name="titulo" id="titulo"
                    class="form-control @error('titulo') is-invalid @enderror" placeholder="Título do TCC"
                    value="{{ $tcc->titulo }}" required>

                @error('titulo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="resumo" class="form-label"><br>Resumo*:</label>
                <textarea name="resumo" id="resumo" class="form-control @error('resumo') is-invalid @enderror" rows="4"
                    placeholder="Resumo do TCC" required>{{ $tcc->resumo }}</textarea>
                @error('resumo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="aluno_id" class="form-label"> <br>Aluno*:</label>
                    <select name="aluno_id" id="aluno_id" class="form-select @error('aluno_id') is-invalid @enderror">
                        <option value="" disabled selected>Selecione um aluno</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}" {{ $aluno->id == $tcc->aluno_id ? 'selected' : '' }}>
                                {{ $aluno->nome }} </option>
                        @endforeach
                    </select>
                    @error('aluno_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <a href="" class="btn btn-info modal-trigger" data-bs-toggle="modal"
                        data-bs-target="#createAluno">Cadastrar novo aluno</a>
                </div>
                @include('modal.createAluno')
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="orientador_id" class="form-label"> <br>Orientador*:</label>
                    <select name="professor_id" id="professor_id"
                        class="form-select @error('professor_id') is-invalid @enderror">
                        <option value="" disabled selected>Selecione um orientador</option>
                        @foreach ($professores as $professor)
                            <option value="{{ $professor->id }}"
                                {{ $professor->id == $tcc->professor_id ? 'selected' : '' }}>
                                {{ $professor->nome }} </option>
                        @endforeach
                    </select>
                    @error('professor_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <a href="" class="btn btn-info modal-trigger" data-bs-toggle="modal"
                        data-bs-target="#createProfessor">Cadastrar novo professor</a>
                </div>
                @include('modal.createProfessor')
            </div>


            <div class="row">
                <div class="mb-3">
                    <label for="banca_id" class="form-label"> <br>Banca*:</label>
                    <select name="banca_id" id="banca_id" class="form-select @error('banca_id') is-invalid @enderror">

                        <option value="" disabled selected>Selecione uma banca</option>
                        @foreach ($bancas as $banca)
                            <option value="{{ $banca->id }}" {{ $banca->id == $tcc->banca_id ? 'selected' : '' }}>
                                {{ date('d-m-Y', strtotime($banca->data)) }} - {{ $banca->local }} -
                                MEMBROS:
                                @foreach ($banca->professoresExternos as $professorExterno)
                                    {{ $professorExterno->nome }} - {{ $professorExterno->filiacao }},
                                @endforeach

                                @foreach ($professores as $professor)
                                    {{ $banca->professores->contains($professor->id) ? '' . $professores->where('id', $professor->id)->first()->nome . ' - IFNMG,' : '' }}
                                @endforeach
                            </option>
                        @endforeach
                    </select>
                    @error('banca_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <a href="" class="btn btn-info modal-trigger" data-bs-toggle="modal"
                        data-bs-target="#createBanca">Cadastrar banca</a>
                </div>
                @include('modal.createBanca')
            </div>

            <div class="mb-3">
                <label for="ano" class="form-label"><br>Ano*:</label>
                <input type="number" name="ano" id="ano" class="form-control @error('ano') is-invalid @enderror"
                    min="2013" value="{{ $anoTcc }}">

                @error('ano')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label"><br>Status*:</label>
                <select name="status" id="status" class="form-select">
                    <option value="0" {{ $tcc->status == 0 ? 'selected' : '' }}>Aguardando defesa</option>
                    <option value="1" {{ $tcc->status == 1 ? 'selected' : '' }}>Concluido</option>
                </select>
                <div class="mb-3" id="arquivo_id">
                    <label for="arquivo" class="form-label"><br>Arquivo:</label>
                    @if ($tcc->status == 1 && $tcc->arquivo)
                        <a href="{{ asset($tcc->arquivo->path) }}" download>{{ $tcc->arquivo->nome }}</a>
                    @endif
                    <input type="file" name="arquivo" id="arquivo" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn custom-button btn-default">Salvar</button>
                <a href="{{ route('tcc.index') }} "
                    class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
            </div>
        </form>


    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var statusSelect = document.getElementById("status");
        var arquivo = document.getElementById("arquivo_id");
        if (statusSelect.value == 1) {
            arquivo.style.display = "block";
        } else {
            arquivo.style.display = "none";
        }

        statusSelect.addEventListener("change", function() {
            if (statusSelect.value === "1") {
                arquivo.style.display = "block";
            } else {
                arquivo.style.display = "none";
            }
        });
    });
</script>
