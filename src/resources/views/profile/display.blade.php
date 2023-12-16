@extends('layouts.main')
@section('title', 'Ciência da Computação')
@section('content')

@php
    $fotoUsers = [];
    foreach ($users as $user) {
        if (count($user->fotos) > 0) {
            foreach ($user->fotos as $ft) {
                if (Storage::disk('public')->exists($ft->foto) && $user->menu_inicial) {
                    $fotoUsers[] = $ft;
                }
            }
        }
    }
@endphp


<div id="demo" class="container carousel slide" data-bs-ride="carousel" data-bs-interval="6000">

    <div class="carousel-indicators" id="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        @foreach ($fotoUsers as $index => $ft)
        <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $index + 1 }}"></button>
        @endforeach
    </div>

    <div class="carousel-inner" id="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/convite_tcc.png') }}" alt="Image 1" class="carousel-image w-100 max-height-carousel">
        </div>
        @foreach ($fotoUsers as $index => $ft)
        <div class="carousel-item">
            <img src="{{ URL::asset('storage') }}/{{ $ft->foto }}" alt="Image {{ $index + 2 }}" class="carousel-image w-100 max-height-carousel">
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container mt-5">
    <h3 class="text-left">Professores Computação:</h3>
</div>

<div class="album py-3 library">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($users as $user)
            <div class="col">
                <div class="card shadow-sm">

                    @if (count($user->fotos) > 0)
                    @foreach ($user->fotos as $ft)
                    @if (Storage::disk('public')->exists($ft->foto))
                    <img src="{{ URL::asset('storage') }}/{{ $ft->foto }}" alt="{{ $user->name }}" class="bd-placeholder-img card-img-top" width="100%">

                    @endif
                    @endforeach
                    @endif

                    <div class="card-body">
                        <p class="card-text">{{ $user->name }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-outline-secondary">Visualizar</a>
                            </div>
                            <small class="text-body-secondary">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
