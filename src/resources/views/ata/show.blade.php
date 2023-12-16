
<div class="modal fade" id="showAta_{{$ata->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ata</h5>
                <button type="button" class="close btn btn-lg" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" name="data" id="data" class="form-control" value="{{ date('Y-m-d', strtotime($ata->data)) }}" disabled>
                </div>
                <div class="form-group">
                    <label for="descricao">Descricao</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="10" class="form-control" disabled>{{ $ata->descricao }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>
