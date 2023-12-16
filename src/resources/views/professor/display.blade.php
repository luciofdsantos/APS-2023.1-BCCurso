@extends('layouts.main')
@section('title', 'Professores')
@section('content')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<section id="team" class="section-padding">
    <div class="container mt-5">
        <div class="row text-center">
            @foreach ($servidores as $servidor)
            <div class="col-md-2 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
                <a href="{{ route('professor.view', ['id' => $servidor->id]) }}" class="a-professor">
                    <div class="nossos-professores" href="#">
                        <div class="team_img">

                            @if ($servidor->foto)
                                <img src="{{ URL::asset('storage') }}/{{ $servidor->foto }}">        
                            @else
                                <img src="{{ asset('images/professor/professor_placeholder.png') }}">
                            @endif

                        </div>
                        <div class="team-content">
                            <h3 class="nome-servidor">{{ $servidor->nome }}</h3>
                            <span class="titulacao-servidor">
                                @if(empty($servidor->titulacao))
                                -
                                @else
                                {{ $servidor->titulacao }}
                                @endif
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection