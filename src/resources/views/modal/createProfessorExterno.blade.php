<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="createProfessorExterno" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar professor externo</h5>
                <button type="button" class="close btn btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome-professor-externo" id="nome-professor-externo" class="form-control" placeholder="Nome do professor externo">
                    <label for="filiacao">Filiação</label>
                    <input type="text" name="filiacao" id="filiacao" class="form-control" placeholder="Nome da instituição de filiação">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn custom-button" data-dismiss="modal" id="cadastrarProfessoExternoButton">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#cadastrarProfessoExternoButton').click(function() {
            var nome = $('#nome-professor-externo').val();
            var filiacao = $('#filiacao').val();

            if (nome.trim() === '' || filiacao.trim() === '') {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            var professoresSelecionadosAntes = [];
            $('input[name="professores_externos[]"]:checked').each(function() {
                professoresSelecionadosAntes.push($(this).val());
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var data = {
                _token: csrfToken,
                nome: nome,
                filiacao: filiacao,
                contexto: 'modal'
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('professor-externo.store') }}",
                data: data,
                success: function(response) {
                    $('#createProfessorExterno').modal('hide');
                    atualizarProfessoresExternos();

                    if (response.error) {
                        alert(response.error);
                    } else {
                        // Feche o modal
                        $('#createProfessorExterno').modal('hide');

                        // Atualiza os checkboxs no modal
                        var professoresCheckboxHTML = '';
                        $.each(response.professores_externos, function(index, professor) {
                            var checkboxId = 'professor_externo_' + professor.id;
                            var isChecked = professoresSelecionadosAntes.includes(professor.id.toString()) ? 'checked' : '';
                            professoresCheckboxHTML +=
                            '<div class="form-check">' +
                            '<input type="checkbox" class="form-check-input" name="professores_externos[]" id="' +
                                checkboxId + '" value="' + professor.id +'" ' + isChecked + '>' +
                            '   <label for= "' + checkboxId + '" class="form-check-label">' + professor.nome + ' - '  + professor.filiacao + '</label>' +
                            '</div>';
                        });

                        $('#professores_externos .form-check').remove();
                        $('#professores_externos').append(professoresCheckboxHTML);

                        var returnToModalSelector = $('#cadastrarProfessorExternoModal').data('return-to-modal');
                        if (returnToModalSelector) {
                            $(returnToModalSelector).modal('show');  // Mostrar o modal de retorno
                        }

                        // Atualize o <select> na página de edição
                        // var $selectProfessor = $('#professor_id');
                        // $selectProfessor.empty(); // Limpe todas as opções

                        // // Adicione as opções atualizadas com base na resposta do servidor
                        // $.each(response.professores, function(index, professor) {
                        //     $selectProfessor.append($('<option>', {
                        //         value: professor.id,
                        //         text: professor.nome
                        //     }));
                        // });
                    }
                },
            });
        });

        function atualizarProfessoresExternos() {
            $.ajax({
                type: 'GET',
                url: "{{ route('professor-externo.index', ['contexto' => 'modal']) }}",
            });
        }
    });
</script>
