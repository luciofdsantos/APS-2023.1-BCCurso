<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Concluir TCC</h5>
                <button type="button" class="close btn btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tcc.concluiTcc', [$tcc->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="mb-3" id="arquivo_id">
                        <h5 class="">Selecione o arquivo do TCC "{{$tcc->titulo}}"</h5>
                        <input type="file" name="arquivo" id="arquivo" class="form-control" required>
                    </div>

                    <div class="modal-footer" id="controle">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Cancel">Cancelar</button>
                        <button type="submit" class="btn custom-button" data-dismiss="modal" id="ConcluirTccButton">
                            Concluir
                        </button>
                        <button type="button" class="btn custom-button" data-dismiss="modal" id="ConcluindoTccButton" hidden='true' disabled>
                            <span id="loading" class="spinner-border spinner-border-sm" data-dismiss="modal"></span>
                            Concluindo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var buttonConcluir = $('#ConcluirTccButton');
        var buttonConcluindo = $('#ConcluindoTccButton')
        var buttonCancel = $('#Cancel')
        var arquivo = $('#arquivo')

        $('#ConcluirTccButton').click(function() {
            if(arquivo.val() === "") {
                alert("Arquivo é obrigatório!")
                return false
            }

            buttonCancel.prop('disabled', true);
            buttonConcluindo.attr('hidden', false);
            buttonConcluir.attr('hidden', true);
        });
    });
</script>
