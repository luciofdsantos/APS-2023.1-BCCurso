<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="createAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar aluno</h5>
                <button type="button" class="close btn btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do aluno">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn custom-button" data-bs-dismiss="modal" id="cadastrarAlunoButton">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#cadastrarAlunoButton').click(function() {
            var nome = $('#nome').val();
            if (nome.trim() === '') {
                alert('Por favor, insira o nome do aluno.');
                return;
            }

            var alunosSelecionadosAntes = [];
            $('input[name="alunos[]"]:checked').each(function() {
                alunosSelecionadosAntes.push($(this).val());
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var data = {
                _token: csrfToken,
                nome: nome,
                contexto: 'modal'
            };

            $.ajax({
                type: 'POST',
                url: "{{ route('aluno.store') }}",
                data: data,
                success: function(response) {

                    $('#createAluno').modal('hide');
                    // Atualiza o <select> na página de edição
                    var $selectAluno = $('#aluno_id');
                    $selectAluno.empty(); // Limpa todas as opções

                    // Atualize a lista de alunos no modal "Cadastrar novo aluno"
                    var alunosCheckboxHTML = '';

                    // Adicione as checkboxes atualizadas com base na resposta do servidor
                    $.each(response.alunos, function(index, aluno) {
                        var checkboxId = 'aluno_' + aluno.id;
                        var isChecked = alunosSelecionadosAntes.includes(aluno.id.toString()) ? 'checked' : '';
                        alunosCheckboxHTML +=
                        '<div class="form-check">' +
                        '<input type="checkbox" class="form-check-input" name="alunos[]" id="' + checkboxId + '" value="' + aluno.id + '" '+ isChecked + '>' +
                        '<label for="' + checkboxId + '" class="form-check-label">' + aluno.nome + '</label>' +
                        '</div>';
                    });

                    $('#alunos .form-check').remove();
                    $('#alunos').append(alunosCheckboxHTML);

                    // Adicione as opções atualizadas com base na resposta do servidor
                    $.each(response.alunos, function(index, aluno) {
                        $selectAluno.append($('<option>', {
                            value: aluno.id,
                            text: aluno.nome
                        }));
                    });
                },
            });
        });
    });
</script>
