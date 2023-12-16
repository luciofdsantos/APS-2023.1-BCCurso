@extends('layouts.main')

@section('title', 'Cadastrar PPC')

@section('content')
<div class="custom-container">
    <div>
        <div>
            <i class="fas fa-person-chalkboard fa-2x"></i>
            <h3 class="smaller-font">Cadastrar PPC</h3>
        </div>
    </div>
</div>
<div class="container">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        @if(is_array($error))
        @foreach($error as $e)
        <div>{{ $e }}</div>
        @endforeach
        @else
        {{ $error }}
        @endif

    </div>
    @endforeach
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ route('ppc.store', ['cursoId' => $cursoId]) }}">
        @csrf
        <div class="form-group">

            <label for="ppc" class="form-label"> <br>PPC:</label>
            <input type="file" name="ppc" id="ppc" class="form-control" accept=".pdf" required>
        </div>
        <div class="form-group">

            <label for="matriz_curricular" class="form-label"> <br>Matriz curricular:</label>
            <input type="file" name="matriz_curricular" id="matriz_curricular" class="form-control" accept=".pdf" required>
        </div>
        <div class="form-group">
            <input id="vigente" {{ old('vigente') ? 'checked' : '' }} name="vigente" type="checkbox">
            <label class="" for="vigente">Vigente</label>

        </div>
        <button type="submit" class="btn custom-button btn-default">Adicionar</button>
        <a href="{{ route('ppc.index', ['cursoId' => $cursoId]) }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Cancelar</a>
    </form>
</div>

@stop