@extends('layouts.main')

@section('title', 'Banca')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Gerenciar Banca</h3>
        </div>
    </div>
</div>
<div class="container">


    <br>
    <div class="row campo-busca">
        <div class="col-md-12">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar em todos os campos" aria-label="Buscar">
        </div>
    </div>
    <br>

    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white div-form">
                    Banca
                    <a href="{{ route('banca.create') }}" class="btn btn-success btn-sm float-end">Cadastrar</a>
                </div>
                <div class="card-body">

                    <table id="bancaTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Local</th>
                                <th>Membros</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bancas as $banca)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($banca->data)) }}</td>
                                <td class="text-wrap">{{ $banca->local }}</td>
                                <td class="text-wrap">
                                    <span style="font-weight: bold;"> Presidente da banca:</span><br>
                                    <span>{{ $banca->presidente->servidor->nome }}</span><br>

                                    @if (count($banca->professoresExternos) > 0)
                                    <span style="font-weight: bold;"> Professores Externos:</span><br>
                                    @foreach ($banca->professoresExternos as $professor_externo)
                                    <span>{{ $professor_externo->nome }} - {{ $professor_externo->filiacao }}
                                    </span><br>
                                    @endforeach
                                    <br>
                                    @endif

                                    @if (count($banca->professores) > 0)
                                    <span style="font-weight: bold;"> Professores Internos:</span><br>
                                    @foreach ($banca->professores as $professor)
                                    <span>{{ $professor->servidor->nome }}</span>
                                    <br>


                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('banca.destroy', $banca->id) }}">
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('banca.show', ['id' => $banca->id]) }}"><i class="fa-solid fa-eye"></i></a>
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a href="{{ route('banca.edit', $banca->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm" title='Delete' onclick="return confirm('Deseja realmente excluir essa banca?')"><i class="fas fa-trash"></i></button>
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
            $("#bancaTable tbody tr").filter(function() {
                // Excluindo a última coluna que é a de ação do filtro
                var rowData = $(this).find("td:not(:last-child)").text().toLowerCase();
                $(this).toggle(rowData.indexOf(searchText) > -1);
            });
        });
    });
</script>
@stop
