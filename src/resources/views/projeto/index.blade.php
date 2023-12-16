@extends('layouts.main')

@section('title', 'Projetos')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-envelopes-bulk fa-2x"></i>
            <h3 class="smaller-font">Gerenciar Projeto</h3>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white div-form">
                    Projetos
                    <a href="{{ route('projeto.create') }}" class="btn btn-success btn-sm float-end">Cadastrar</a>
                </div>
                <div class="card-body">

                    <table id="projetoTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Data Inicio</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projetos as $projeto)
                            <tr>
                                <td class="text-wrap">{{ $projeto->titulo }}</td>
                                <td>{{ date('d/m/Y', strtotime($projeto->data_inicio)) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('projeto.destroy', $projeto->id) }}">
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('projeto.show', ['id' => $projeto->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('projeto.edit', $projeto->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $("#projetoTable tbody tr").filter(function() {
                // Excluindo a última coluna que é a de ação do filtro
                var rowData = $(this).find("td:not(:last-child)").text().toLowerCase();
                $(this).toggle(rowData.indexOf(searchText) > -1);
            });
        });
    });
</script>

@stop