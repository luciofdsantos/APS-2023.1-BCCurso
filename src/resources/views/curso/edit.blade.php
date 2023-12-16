@extends('layouts.main')

@section('title', 'Editar Curso')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-graduation-cap fa-2x"></i>
            <h3 class="smaller-font">Editar Curso</h3>
        </div>
    </div>
</div>
<div class="container">

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        @if(is_array($error))
        @foreach($error as $e)
        <div>{{ $e }}</div>
        @endforeach
        @else
        {{ $error }}
        @endif

    </div>
    @endforeach
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('curso.update', $curso->id) }}">
        @csrf
        @method('PUT') {{-- Usamos @method('PUT') para indicar que esta é uma atualização --}}

        <div class="form-group mb-3">

            <label for="titulo" class="form-label"> <br>Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" value="{{ $curso->nome }}" placeholder="Informe o nome do Curso" required>
        </div>

        <div class="form-group mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" cols="30" rows="5" class="form-control" maxlength="5000">{{ $curso->descricao }}</textarea>
        </div>

        <div class="form-group mb-3">

            <label for="titulo" class="form-label"> <br>Turno:</label>
            <select class="form-control" id="turno" name="turno" required>
                <option value="Matutino" @if($curso->turno == 'Matutino') selected @endif>Matutino</option>
                <option value="Vespertino" @if($curso->turno == 'Vespertino') selected @endif>Vespertino</option>
                <option value="Noturno" @if($curso->turno == 'Noturno') selected @endif>Noturno</option>
                <option value="Integral" @if($curso->turno == 'Integral') selected @endif>Integral</option>
            </select>
        </div>
        <div class="form-group mb-3">

            <label for="titulo" class="form-label"> <br>Carga Horária:</label>
            <input class="form-control" type="number" id="carga_horaria" min="0" max="10000" name="carga_horaria" value="{{ $curso->carga_horaria }}" placeholder="Informe a carga horária" required>
        </div>
        <div class="form-group mb-3">

            <label for="titulo" class="form-label"> <br>Sigla:</label>
            <input class="form-control" type="text" id="sigla" name="sigla" value="{{ $curso->sigla }}" placeholder="Informe a sigla" maxlength="5" required>
        </div>

        <div class="form-group mb-3">
            <label for="modalidade" class="form-label"> <br>Modalidade:</label>

            <select class="form-control" id="modalidade" name="modalidade" required>
                <option value="presencial" @if($curso->modalidade == 'presencial') selected @endif >Presencial</option>
                <option value="ensino_a_distancia" @if($curso->modalidade == 'ensino_a_distancia') selected @endif >Ensino a Distância (EAD)</option>
                <option value="semipresencial" @if($curso->modalidade == 'semipresencial') selected @endif >Semipresencial</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tipo" class="form-label"> <br>Tipo:</label>

            <select class="form-control" id="tipo" name="tipo" required>
                <option value="bacharelado" @if($curso->tipo == 'bacharelado') selected @endif >Bacharelado</option>
                <option value="licenciatura" @if($curso->tipo == 'licenciatura') selected @endif >Licenciatura</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="habilitacao" class="form-label"> <br>Habilitação:</label>
            <input class="form-control" type="text" id="habilitacao" name="habilitacao" value="{{ $curso->habilitacao }}" placeholder="Informe a habilitação do curso" maxlength="255" required>
        </div>


        <div class="form-group mb-3">

            <label for="ano_implementacao" class="form-label"> <br>Ano de implementação:</label>
            <input class="form-control" type="Number" id="ano_implementacao" value="{{ $curso->ano_implementacao }}" name="ano_implementacao" placeholder="Informe o ano de implementação" min="1900" max="{{ date('Y') }}" required>
        </div>

        <div class="form-group mb-3">

            <label for="vagas_ofertadas_anualmente" class="form-label"> <br>Vagas ofertadas anualmente:</label>
            <input class="form-control" type="Number" id="vagas_ofertadas_anualmente" value="{{ $curso->vagas_ofertadas_anualmente }}" name="vagas_ofertadas_anualmente" placeholder="Informe o numero de vagas ofertadas anualmente" min="0" max="1000">
        </div>

        <div class="form-group mb-3">

            <label for="vagas_ofertadas_turma" class="form-label"> <br>Vagas ofertadas por turma:</label>
            <input class="form-control" type="Number" id="vagas_ofertadas_turma" value="{{ $curso->vagas_ofertadas_turma }}" name="vagas_ofertadas_turma" placeholder="Informe o numero de vagas ofertadas por turma" min="0" max="1000">
        </div>

        <div class="form-group mb-3">
            <fieldset>
                <legend class="form-label">Formas de Acesso:</legend>
                <label for="vestibular">
                    <input type="checkbox" id="vestibular" name="formas_acesso[]" value="Vestibular" {{ in_array('Vestibular', $curso->formasAcesso()->pluck('forma_acesso')->toArray()) ? 'checked' : '' }}> Vestibular
                </label>
                <br>
                <label for="sisu">
                    <input type="checkbox" id="sisu" name="formas_acesso[]" value="SISU" {{ in_array('SISU', $curso->formasAcesso()->pluck('forma_acesso')->toArray()) ? 'checked' : '' }}> SISU
                </label>
                <br>
            </fieldset>
        </div>

        <div class="form-group mb-3" id="distribuicao_vagas">
            <fieldset>
                <label class="form-label">Distribuição de Vagas (%):</label><br>
                <div id="vestibular_fields">
                    <label class="form-label" for="vestibular">Vestibular</label>
                    <input class="form-control" type="number" id="vestibular_percent" value="{{ $curso->formasAcesso->where('forma_acesso', 'Vestibular')->first()->porcentagem_vagas ?? '' }}" name="vestibular_percent" min="0" max="100" step="0.01">
                </div>
                <br>
                <div id="sisu_fields">
                    <label class="form-label" for="sisu">SISU</label>
                    <input class="form-control" type="number" id="sisu_percent" value="{{ $curso->formasAcesso->where('forma_acesso', 'SISU')->first()->porcentagem_vagas ?? '' }}" name="sisu_percent" min="0" max="100" step="0.01">
                </div>
            </fieldset>
        </div>

        <div class="form-group mb-3">
            <label for="periodicidade_ingresso" class="form-label"> <br>Periodicidade de ingresso:</label>

            <select class="form-control" id="periodicidade_ingresso" name="periodicidade_ingresso" required>
                <option value="anual" @if($curso->periodicidade_ingresso == 'anual') selected @endif>Anual</option>
                <option value="semestral" @if($curso->periodicidade_ingresso == 'semestral') selected @endif>Semestral</option>
                <option value="trimestral" @if($curso->periodicidade_ingresso == 'trimestral') selected @endif>Trimestral</option>
                <option value="mensal" @if($curso->periodicidade_ingresso == 'mensal') selected @endif>Mensal</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="tempo_min_conclusao"><br>Tempo minímo para integralização (anos):</label>
            <input class="form-control" type="number" id="tempo_min_conclusao" name="tempo_min_conclusao" min="1" step="0.5" max="10" value="{{ $curso->tempo_min_conclusao }}">
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="tempo_max_conclusao"><br>Tempo máximo para integralização (anos):</label>
            <input class="form-control" type="number" id="tempo_max_conclusao" name="tempo_max_conclusao" min="1" step="0.5" max="20" value="{{ $curso->tempo_max_conclusao }}">
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="nota_enade"><br>Nota no ENADE:</label>
            <input class="form-control" type="number" id="nota_enade" name="nota_enade" min="1" max="5" value="{{ $curso->nota_enade }}">
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="nota_in_loco_SINAES"><br>Nota no in loco –SINAES:</label>
            <input class="form-control" type="number" id="nota_in_loco_SINAES" name="nota_in_loco_SINAES" value="{{ $curso->nota_in_loco_SINAES }}" min="1" max="5">
        </div>

        <div class="form-group mb-3">
            <label for="titulo" class="form-label"> <br>Analytics:</label>
            <input class="form-control" type="text" id="analytics" name="analytics" value="{{ $curso->analytics }}" placeholder="Informe o analytics">
        </div>

        <div class="form-group">
            <label for="titulo" class="form-label"> <br>Ato de autorização:</label>
            <input type="file" name="ato_autorizacao" id="ato_autorizacao" class="form-control" accept=".pdf">
            @if($curso->atoAutorizacao && $curso->atoAutorizacao->path)
            <p>Ato de autorização atual: <a href="{{ asset('storage/' . $curso->atoAutorizacao->path) }}" target="_blank">{{ $curso->atoAutorizacao->nome }}</a></p>
            @endif
        </div>

        <div class="form-group">

            <label for="titulo" class="form-label"> <br>Calendário:</label>
            @if($curso->calendario)
            <button class="btn text-danger" type="submit" form="deletar-calendario{{ $curso->id }}" onclick="return confirm('Deseja realmente excluir esse arquivo?')">X</button>
            <a href="{{ asset('storage/' . $curso->calendario) }}" target="_blank">Ver Calendário</a>
            @else
            <input type="file" name="calendario" id="calendario" class="form-control" accept=".pdf">
            @endif
        </div>

        <div class="form-group">

            <label for="titulo" class="form-label"> <br>Horário:</label>
            @if($curso->horario)
            <button class="btn text-danger" type="submit" form="deletar-horario{{ $curso->id }}" onclick="return confirm('Deseja realmente excluir esse arquivo?')">X</button>
            <a href="{{ URL::asset('storage/' . $curso->horario) }}" target="_blank">Ver Horário</a>
            @else
            <input type="file" name="horario" id="horario" class="form-control" accept=".pdf">
            @endif
        </div>

        <button type="submit" class="btn custom-button btn-default">Atualizar</button>
        <a href="{{ route('curso.index') }}" class="btn custom-button custom-button-castastrar-tcc btn-default btn-back">Cancelar</a>
    </form>

    @if ($curso->atoAutorizacao)
    <form id="deletar-atoAutorizacao{{ $curso->id}}" action="{{ route('curso.delete_atoAutorizacao', ['id' => $curso->id]) }}" method="post">
        @csrf
        @method('delete')
    </form>
    @endif

    @if ($curso->calendario)
    <form id="deletar-calendario{{ $curso->id}}" action="{{ route('curso.delete_calendario', ['id' => $curso->id]) }}" method="post">
        @csrf
        @method('delete')
    </form>
    @endif

    @if ($curso->horario)
    <form id="deletar-horario{{$curso->id}}" action="{{ route('curso.delete_horario', ['id' => $curso->id]) }}" method="post">
        @csrf
        @method('delete')
    </form>
    @endif

</div>

<script>
    const distribuicaoDiv = document.getElementById('distribuicao_vagas');
    const vestibularInput = document.getElementById("vestibular");
    const sisuInput = document.getElementById("sisu");
    const vestibularFields = document.getElementById("vestibular_fields");
    const sisuFields = document.getElementById("sisu_fields");

    function toggleInputs() {
        if (vestibularInput.checked || sisuInput.checked) {
            distribuicaoDiv.style.display = "block";

            if (vestibularInput.checked) {
                vestibularFields.style.display = "block";
            } else {
                vestibularFields.style.display = "none";
            }

            if (sisuInput.checked) {
                sisuFields.style.display = "block";
            } else {
                sisuFields.style.display = "none";
            }

        } else {
            distribuicaoDiv.style.display = "none";
        }
    }

    vestibularInput.addEventListener("change", toggleInputs);
    sisuInput.addEventListener("change", toggleInputs);

    toggleInputs();

    document.getElementById('vagas_ofertadas_turma').addEventListener('input', function() {
        var vagasAnuais = document.getElementById('vagas_ofertadas_anualmente').value;
        var vagasTurma = this.value;

        if (parseInt(vagasTurma) > parseInt(vagasAnuais)) {
            this.setCustomValidity('O número de vagas por turma não pode ser maior que o número de vagas anuais.');
        } else {
            this.setCustomValidity('');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var vestibularCheckbox = document.getElementById('vestibular');
        var sisuCheckbox = document.getElementById('sisu');
        var vestibularPercentInput = document.getElementById('vestibular_percent');
        var sisuPercentInput = document.getElementById('sisu_percent');

        vestibularCheckbox.addEventListener('change', function() {
            validatePercentages();
        });

        sisuCheckbox.addEventListener('change', function() {
            validatePercentages();
        });

        vestibularPercentInput.addEventListener('input', function() {
            validatePercentages();
        });

        sisuPercentInput.addEventListener('input', function() {
            validatePercentages();
        });

        function validatePercentages() {
            var vestibularPercent = parseFloat(vestibularPercentInput.value) || 0;
            var sisuPercent = parseFloat(sisuPercentInput.value) || 0;

            var vestibularChecked = vestibularCheckbox.checked;
            var sisuChecked = sisuCheckbox.checked;

            var requiredFieldsFilled = (!vestibularChecked || vestibularPercent !== 0) && (!sisuChecked || sisuPercent !== 0);

            vestibularPercentInput.value = vestibularChecked ? vestibularPercent : null;
            sisuPercentInput.value = sisuChecked ? sisuPercent : null;

            var somaPercentagens = (vestibularPercent || 0) + (sisuPercent || 0);

            vestibularPercentInput.setCustomValidity((vestibularChecked && !requiredFieldsFilled) ? 'Campo obrigatório' : '');
            sisuPercentInput.setCustomValidity((sisuChecked && !requiredFieldsFilled) ? 'Campo obrigatório' : '');

            vestibularPercentInput.setCustomValidity(somaPercentagens !== 100 && (vestibularChecked || sisuChecked) ? 'A soma das percentagens deve ser exatamente 100%.' : '');
            sisuPercentInput.setCustomValidity(somaPercentagens !== 100 && (vestibularChecked || sisuChecked) ? 'A soma das percentagens deve ser exatamente 100%.' : '');

            return (somaPercentagens === 100) && requiredFieldsFilled;
        }
    });
</script>

@stop