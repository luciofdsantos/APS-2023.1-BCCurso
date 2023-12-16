@extends('layouts.main')

@section('title', 'Professores')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-person-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Gerenciar Professor</h3>
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
                    Professores
                    <a href="{{ route('professor.create') }}" class="btn btn-success btn-sm float-end">Cadastrar</a>
                </div>
                <div class="card-body">

                    <table id="professorTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Criação</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servidores as $servidor)
                            <tr>
                                <td class="text-wrap">{{ $servidor->nome }}</td>
                                <td class="text-wrap">{{ $servidor->email }}</td>
                                <td>{{ date_format($servidor->created_at, 'd/m/Y H:i:s') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('professor.destroy', $servidor->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a class="btn btn-success btn-sm" href="{{ route('professor.view', ['id' => $servidor->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('professor.edit', $servidor->id) }}"><i class="fas fa-pencil-alt"></i></a>
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

<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $("#professorTable tbody tr").filter(function() {
                // Excluindo a última coluna que é a de ação do filtro
                var rowData = $(this).find("td:not(:last-child)").text().toLowerCase();
                $(this).toggle(rowData.indexOf(searchText) > -1);
            });
        });
    });
</script>
@stop