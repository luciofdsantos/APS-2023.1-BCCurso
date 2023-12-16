@extends('layouts.main')
@section('title', 'TCC')
@section('content')

    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-graduation-cap fa-2x"></i>
                <h3 class="smaller-font">TCC</h3>
            </div>
        </div>
    </div>
    <br>

    <ul class="nav nav-tabs container" id="myTabs">
        <li class="nav-item nav-item-tcc">
            <a class="nav-link active" id="professor-tab" data-toggle="tab" href="#professor" role="tab"
                aria-controls="professor" aria-selected="true">Orientador</a>
        </li>
        <li class="nav-item nav-item-tcc">
            <a class="nav-link" id="ano-tab" data-toggle="tab" href="#ano" role="tab" aria-controls="ano"
                aria-selected="false">Ano</a>
        </li>
    </ul>

    <div class="tab-content " id="myTabContent">
        <div class="tab-pane fade show active" id="professor" role="tabpanel" aria-labelledby="professor-tab">
            <div class="event-schedule-area-two bg-color pad100">
                <div class="container">
                    @foreach ($professores as $nomeProfessor => $tccsProfessor)
                        <div class="professor-section mt-4">

                            <ul class="list-group custom-ul">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center custom-title-tcc">
                                    <span class="divisao-tcc text-wrap">
                                        {{ $nomeProfessor }}
                                    </span>
                                    <span class="badge badge-primary custom-badge">{{ count($tccsProfessor) }}</span>
                                </li>
                                @foreach ($tccsProfessor as $tcc)
                                    <li class="list-group-item tcc-item d-flex justify-content-between align-items-center">

                                        <a href="{{ route('tcc.view', ['id' => $tcc->id]) }}" class="text-left text-wrap"
                                            data-toggle="tooltip" data-placement="top" title="{{ $tcc->titulo }}">
                                            {{ $tcc->titulo }}
                                        </a>
                                        @if ($tcc->status == 0)
                                            <span class="badge bg-warning">Aguardando Defesa</span>
                                        @elseif ($tcc->status == 1)
                                            <span class="badge bg-success">Concluído</span>
                                        @endif

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ano" role="tabpanel" aria-labelledby="ano-tab">
            <div class="event-schedule-area-two bg-color pad100">
                <div class="container">
                    @foreach ($tccsPorAno as $ano => $tccsAno)
                        <div class="ano-section mt-4">
                            <ul class="list-group">

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center custom-title-tcc">
                                    <span class="divisao-tcc text-wrap">
                                        {{ $ano }}
                                    </span>
                                    <span class="badge badge-primary custom-badge">{{ count($tccsAno) }}</span>
                                </li>

                                @foreach ($tccsAno as $tcc)
                                    <li class="list-group-item tcc-item d-flex justify-content-between align-items-center text-wrap">
                                        <a href="{{ route('tcc.view', ['id' => $tcc->id]) }}">{{ $tcc->titulo }}</a>
                                        @if ($tcc->status == 0)
                                            <span class="badge bg-warning">Aguardando Defesa</span>
                                        @elseif ($tcc->status == 1)
                                            <span class="badge bg-success">Concluído</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.tcc-item').click(function() {
                window.location = $(this).find('a').attr('href');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTabs a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
@endsection
