@extends('layouts.main')

@section('title', 'Gerenciar PPC')

@section('content')
<div class="container mt-4">
    <div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white div-form">
                    PPCs
                    <a href="{{ route('ppc.create', ['cursoId' => $curso->id]) }}" class="btn btn-primary">Criar Novo PPC</a>
                </div>

                <div class="card-body">
                    <table id="cursoTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>PPC</th>
                                <th>Matriz Curricular</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($ppcs) && !empty($ppcs))
                            @foreach ($ppcs as $ppc)
                            <tr>
                                <td><a target="_blank" href="{{ asset('storage/' . $ppc->path) }}">{{ $ppc->nome }}</a></td>
                                <td><a target="_blank" href="{{ $ppc->matriz ? asset('storage/' . $ppc->matriz->path) : '#' }}">{{ $ppc->matriz ? $ppc->matriz->nome : 'N/A' }}</a></td>
                                <td>{{ $ppc->vigente ? 'Vigente' : 'Não Vigente' }}</td>
                                <td>
                                    <form method="POST" action="{{ route('ppc.destroy', ['cursoId' => $curso->id, 'ppc' => $ppc->id]) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <a class="btn btn-primary btn-sm" href="{{ route('ppc.edit', ['cursoId' => $curso->id, 'ppc' => $ppc->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm" title='Delete' onclick="return confirm('Deseja realmente excluir esse ppc?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <a href="{{ route('curso.index') }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Voltar</a>
        </div>
    </div>
</div>

@stop