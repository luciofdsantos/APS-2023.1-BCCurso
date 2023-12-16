@extends('layouts.main')
@section('title', 'TCC')
@section('content')

    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h3 class="smaller-font">Gerenciar TCC</h3>
            </div>
        </div>
    </div>

    <div class="container">

        <br>
        <div class="row campo-busca">
            <div class="col-md-12">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar em todos os campos"
                    aria-label="Buscar">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white div-form">
                        TCC
                        <a href="{{ route('tcc.create') }}" class="btn btn-success btn-sm float-end">Cadastrar</a>
                    </div>
                    <div class="table-responsive">

                        <table id="tccTable" class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Título</th>
                                    <th class="text-center">Resumo</th>
                                    <th class="text-center">Arquivo</th>
                                    <th class="text-center">Aluno</th>
                                    <th class="text-center">Orientador</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tccs as $tcc)
                                    <tr>
                                        <td class="text-left text-wrap" data-toggle="tooltip" data-placement="top"
                                            title="{{ $tcc->titulo }}">
                                            {{$tcc->titulo}}
                                        </td>

                                        <td class="text-center text-wrap" data-toggle="tooltip" data-placement="top"
                                            title="{{ $tcc->resumo }}">
                                            {{ $tcc->resumo }}
                                        </td>

                                        <td>
                                            @if ($tcc->arquivo)
                                                <a href="{{ URL::asset('storage') }}/{{ $tcc->arquivo->path }}"
                                                    download>{{ strlen($tcc->arquivo->nome) > 30 ? substr($tcc->arquivo->nome, 0, 30) . '...' : $tcc->arquivo->nome }}</a>
                                            @else
                                                Não há arquivo cadastrado!
                                            @endif
                                        </td>
                                        <td class="text-left text-wrap" data-toggle="tooltip" data-placement="top"
                                            title="{{ $tcc->aluno->nome }}">
                                            {{ $tcc->aluno->nome }}
                                        </td>
                                        <td class="text-left text-wrap" data-toggle="tooltip" data-placement="top"
                                        > {{ $professores->contains($tcc->professor_id) ? $professores->where('id', $tcc->professor_id)->first()->nome : '' }}
                                        </td>
                                        <td> {{ $tcc->status == 0 ? 'Aguardando defesa' : 'Concluido' }} </td>
                                        <td class="text-center nowrap-td">

                                            <form method="POST" action="{{ route('tcc.destroy', $tcc->id) }}">
                                                @csrf
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('tcc.view', ['id' => $tcc->id]) }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                @if ($tcc->status == 0)
                                                    <a href="" class="btn btn-success btn-sm modal-trigger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#concluirTcc_{{ $tcc->id }}"><i
                                                            class="fas fa-check"></i></a>
                                                @endif
                                                <input name="_method" type="hidden" value="DELETE">
                                                <a href="{{ route('tcc.edit', $tcc->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm" title='Delete'
                                                    onclick="return confirm('Deseja realmente excluir esse registro?')"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @include('modal.concluirTcc', ['modalId' => 'concluirTcc_' . $tcc->id])
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
                $("#tccTable tbody tr").filter(function() {
                    // Excluindo a última coluna que é a de ação do filtro
                    var rowData = $(this).find("td:not(:last-child)").text().toLowerCase();
                    $(this).toggle(rowData.indexOf(searchText) > -1);
                });
            });
        });
    </script>

@endsection
