@extends('layouts.main')

@section('title', 'Cadastrar Ata')

@section('content')
    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-person-chalkboard fa-2x"></i>
                <h3 class="smaller-font">Cadastrar ata</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="post" action="{{ route('ata.store') }}">
            @csrf
            <div class="mb-3">
                <label class="mt-5" for="colegiado">Colegiado</label>
                <select class="form-select" name="colegiado" id="colegiadoSelect" onchange="atualizarLimitesData()">
                    @foreach ($colegiados as $colegiado)
                            <option value="{{ $colegiado->id }}"
                                data-inicio="{{ date('d-m-Y', strtotime($colegiado->inicio)) }}"
                                data-fim="{{ date('d-m-Y', strtotime($colegiado->fim)) }}"
                                {{ $colegiado->atual == 1 ? 'selected' : '' }}>
                                Nº {{ $colegiado->numero_portaria }}
                                de {{ date('d/m/Y', strtotime($colegiado->inicio)) }}
                                até {{ date('d/m/Y', strtotime($colegiado->fim)) }}

                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="mt-5" for="data">Data</label>
                <input class="form-control" id="data" name="data" type="date" value="" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição*: </label>
                    <textarea name="descricao" id="descricao" cols="50" rows="10" placeholder="Descrição da ata" required
                        class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>


                        @error('descricao')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>


            <button type="submit" class="btn custom-button btn-default">Cadastrar</button>
            <a href="{{ route('colegiado.index') }} "
                class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
        </form>
    </div>
@stop

<script>
    document.addEventListener('DOMContentLoaded', function() {
    atualizarLimitesData();
    });

    function atualizarLimitesData() {
        var colegiadoSelect = document.getElementById('colegiadoSelect')
        var selectedColegiado = colegiadoSelect.options[colegiadoSelect.selectedIndex]

        var dataIput = document.getElementById('data')
        var inicio = selectedColegiado.getAttribute("data-inicio")
        var fim = selectedColegiado.getAttribute("data-fim")

        inicio = inicio.split('-').reverse().join('-');
        fim = fim.split('-').reverse().join('-');

        dataIput.setAttribute("min", inicio)
        dataIput.setAttribute("max", fim)
        dataIput.setAttribute("value", inicio)
    }
</script>
