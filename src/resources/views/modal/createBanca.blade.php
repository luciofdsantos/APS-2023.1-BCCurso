<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="modal fade" id="createBanca" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar banca</h5>
                <button type="button" class="close btn btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="data">Data da banca</label>
                    <input type="date" name="data" id="data" class="form-control">
                    <label for="local">Local</label>
                    <input type="text" name="local" id="local" class="form-control" placeholder="Local da banca">

                    <div class="mb-3 row">
                        <label for="" class="form-label col-sm-2 col-form-label">Presidente:</label>
                        <div class="col-sm-9">
                            <input id="textPresidente" type="text" readonly class="form-control-plaintext" value="">
                        </div>
                        <span class="text-danger">O presidente da banca é o orientador selecionado anteriormente</span>
                    </div>

                    <div class="form-group" id="professores">
                        <label for="professores">Professores internos</label>
                        @foreach ($professores as $professor_interno)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="professores_internos[]" id="professor_{{$professor_interno->id}}" value="{{$professor_interno->id}}">
                            <label for="professor_{{$professor_interno->id}}" class="form-check-label text-wrap">{{$professor_interno->nome}} </label>
                        </div>
                        @endforeach
                    </div>
                    <a href="" id="cadastrarProfessorModalBanca" class="modal-trigger" data-bs-toggle="modal"
                    data-bs-target="#createProfessorBanca" data-return-to-modal="#createBanca">Cadastrar professor interno</a>
                    <div class="form-group" id="professores_externos">
                        <label for="professores">Professores externos</label>

                        @foreach ($professores_externos as $professor_externo)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="professores_externos[]" id="professor_externo_{{$professor_externo->id}}" value="{{$professor_externo->id}}">
                            <label for="professor_externo_{{$professor_externo->id}}" class="form-check-label text-wrap">{{$professor_externo->nome}} - {{$professor_externo->filiacao}}</label>
                        </div>
                        @endforeach
                    </div>
                    <a href="" id="cadastrarProfessorExternoModal" class=" modal-trigger" data-bs-toggle="modal" data-bs-target="#createProfessorExterno" data-return-to-modal="#createBanca">Cadastrar professor externo</a>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="buttonCancelBanca">Cancelar</button>
                <button type="button" class="btn custom-button" data-dismiss="modal" id="cadastrarBancaButton">
                    Cadastrar
                </button>
                <button type="button" class="btn custom-button" data-dismiss="modal" id="cadastrandoBancaButton" hidden disabled>
                    <span id="iconLoadingBanca" class="spinner-border spinner-border-sm" data-bs-dismiss="modal" aria-hidden="true"></span>
                    Cadastrando
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#professor_id').on('change', function() {
            var orientadorNome = $('#professor_id option:selected').text();
            var orientadorId = $('#professor_id option:selected').val();

            $('#textPresidente').val(orientadorNome);

            $('input[name="professores_internos[]"]').prop('checked', false);
            $('input[name="professores_internos[]"]').prop('disabled', false);

            // Marque o checkbox correspondente ao presidente selecionado
            $('#professor_' + orientadorId).prop('checked', true);
            $('#professor_' + orientadorId).prop('disabled', true);
        });

        $('#cadastrarBancaButton').click(function() {
        var buttonCadastrar = $('#cadastrarBancaButton');
        var buttonCancelar = $('#buttonCancelBanca');
        var buttonCadastrando = $('#cadastrandoBancaButton');
        var presidente = $('#professor_id option:selected').val();

        if (!presidente) {
            alert("Por favor, selecione um orientador");
            $('#createBanca').modal('hide');
            return;
        }

        loading();

        var data = $('#data').val();
        var local = $('#local').val();


        var professoresInternos = [];
        $('input[name="professores_internos[]"]:checked').each(function() {
            professoresInternos.push($(this).val());
        });

        var professoresExternos = [];
        $('input[name="professores_externos[]"]:checked').each(function() {
            professoresExternos.push($(this).val());
        });


        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var data = {
            _token: csrfToken,
            data: data,
            local: local,
            professores_internos: professoresInternos,
            professores_externos: professoresExternos,
            presidente: presidente,
            contexto: 'modal'
        };

        $.ajax({
            type: 'POST',
            url: "{{ route('banca.store') }}",
            data: data,
            success: function(response) {
                loading();
                console.log(response);

                //Atualizar select de bancas
                $selectBanca = $('#banca_id');
                $selectBanca.empty();

                $.each(response.bancas, function(index, banca) {
                    var dataFormatada = new Date(banca.data);
                    var options = {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    };
                    var dataFormatadaTexto = dataFormatada.toLocaleDateString('pt-BR', options);

                    var professoresExternosTexto = "";
                    if (banca.professores_externos && banca.professores_externos.length > 0) {
                        var professoresArray = banca.professores_externos.map(function(professor) {
                            return professor.nome + " - " + professor.filiacao;
                        });

                        professoresExternosTexto = professoresArray.join(", ");
                    }

                    var professoresInternosTexto = "";
                    if (banca.professores && banca.professores.length > 0) {
                        var professoresInternosArray = banca.professores.map(function(professor) {
                            return professor.servidor.nome + " - IFNMG";
                        });

                        professoresInternosTexto = professoresInternosArray.join(", ");
                    }

                    var texto = dataFormatadaTexto + " - " + banca.local + " - MEMBROS: " + professoresExternosTexto + ", " + professoresInternosTexto;
                    $selectBanca.append($('<option>', {
                        value: banca.id,
                        text: texto
                    }));
                });
                loaded();
                alert('Banca cadastrada com sucesso!');
                $('#createBanca').modal('hide');
            },
            error: function(error) {
                alert('Ocorreu um erro ao cadastrar a banca.');
                $('#createBanca').modal('hide');
                loaded();
            }
        });

        function loading() {
            buttonCadastrar.prop('hidden', true);
            buttonCancelar.prop('disabled', true);
            buttonCadastrando.prop('hidden', false);
        }

        function loaded() {
            buttonCadastrar.prop('hidden', false);
            buttonCancelar.prop('disabled', false);
            buttonCadastrando.prop('hidden', true);
        }
    });
});
</script>
