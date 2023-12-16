@extends('layouts.main')

@section('title', 'Postagens')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-paste fa-2x"></i>
            <h3 class="smaller-font">Gerenciar Postagem</h3>
        </div>
    </div>
</div>

<div class="container">
    <div class="row campo-busca">
        <div class="col-md-12">
            <input type="text" id="searchInput" class="form-control field-search" placeholder="Buscar em todos os campos" aria-label="Buscar">
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white div-form">
                        Postagens
                        <a href="{{ route('postagem.create') }}" class="btn btn-success btn-sm float-end">Cadastrar</a>
                    </div>
                    <div class="card-body">

                        <table id="postagemTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Criação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postagens as $postagem)
                                <tr>
                                    <td class="text-left text-wrap" data-toggle="tooltip" data-placement="top" title="{{ $postagem->titulo }}">
                                        {{ $postagem->titulo }}
                                    </td>

                                    <td>{{ date_format($postagem->created_at, 'd/m/Y H:i:s') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('postagem.destroy', $postagem->id) }}">
                                            @csrf
                                            <a class="btn btn-success btn-sm" href="{{ route('postagem.show', ['id' => $postagem->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a href="{{ route('postagem.edit', $postagem->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm" title='Delete' onclick="return confirm('Deseja realmente excluir esse registro?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $("#postagemTable tbody tr").filter(function() {
                // Excluindo a última coluna que é a de ação do filtro
                var rowData = $(this).find("td:not(:last-child)").text().toLowerCase();
                $(this).toggle(rowData.indexOf(searchText) > -1);
            });
        });
    });
</script>
@stop