@extends('layouts.main')
@section('title', 'Lista de Projetos')
@section('content')

    <div class="custom-container">
        <div>
            <div>
                <i class="fas fa-envelopes-bulk fa-2x"></i>
                <h3 class="smaller-font">Projetos</h3>
            </div>
        </div>
    </div>
    <br>

    <ul class="nav nav-tabs container" id="myTabs">
        <li class="nav-item nav-item-tcc">
            <a class="nav-link active" id="professor-tab" data-toggle="tab" href="#professor" role="tab"
                aria-controls="professor" aria-selected="true">Coordenador</a>
        </li>
        <li class="nav-item nav-item-tcc">
            <a class="nav-link" id="ano-tab" data-toggle="tab" href="#ano" role="tab" aria-controls="ano"
                aria-selected="false">Ano de início</a>
        </li>
    </ul>

    @php
        $professores = [];
        $datas = [];
    @endphp

    @foreach ($projetos as $projeto)
        @if (!in_array($projeto->professor->servidor->nome, $professores))
            @php
                array_push($professores, $projeto->professor->servidor->nome);
            @endphp
        @endif
    @endforeach

    @foreach ($projetos as $projeto)
        @if (!in_array(\Carbon\Carbon::parse($projeto->data_inicio)->format('Y'), $datas))
            @php
                array_push($datas, \Carbon\Carbon::parse($projeto->data_inicio)->format('Y'));
            @endphp
        @endif
    @endforeach

    <div class="tab-content " id="myTabContent">
        <div class="tab-pane fade show active" id="professor" role="tabpanel" aria-labelledby="professor-tab">
            <div class="event-schedule-area-two bg-color pad100">
                <div class="container">

                    @foreach ($professores as $professor)
                        @php
                            $quantidade_projetos_professor = 0;
                        @endphp
                        @foreach ($projetos as $projeto)
                            @if ($projeto->professor->servidor->nome == $professor)
                                @php
                                    $quantidade_projetos_professor++;
                                @endphp
                            @endif
                        @endforeach

                        <div class="professor-section mt-4">
                            <ul class="list-group custom-ul">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center custom-title-tcc">
                                    <span class="divisao-tcc text-wrap">
                                        {{ $professor }}
                                    </span>
                                    <span class="badge badge-primary custom-badge">
                                        {{ $quantidade_projetos_professor }}</span>
                                </li>

                                @foreach ($projetos as $projeto)
                                    @if ($projeto->professor->servidor->nome == $professor)
                                        <li
                                            class="list-group-item tcc-item d-flex justify-content-between align-items-center text-wrap">
                                            <a
                                                href="{{ route('projeto.show', ['id' => $projeto->id]) }}">{{ $projeto->titulo }}</a>

                                            @if (date('Y-m-d') > $projeto->data_termino)
                                                <span class="badge bg-success">Concluído</span>
                                            @else
                                                <span class="badge bg-warning">Não concluído</span>
                                            @endif

                                        </li>
                                    @endif
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

                    @foreach ($datas as $data)
                        @php
                            $quantidade_datas = 0;
                        @endphp
                        @foreach ($projetos as $projeto)
                            @if (\Carbon\Carbon::parse($projeto->data_inicio)->format('Y') == $data)
                                @php
                                    $quantidade_datas++;
                                @endphp
                            @endif
                        @endforeach

                        <div class="ano-section mt-4">
                            <ul class="list-group">

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center custom-title-tcc">
                                    <span class="divisao-tcc">
                                        <span class="text-wrap">{{ $data }}</span>
                                    </span>
                                    <span class="badge badge-primary custom-badge"> {{ $quantidade_datas }}</span>

                                </li>


                                @foreach ($projetos as $projeto)
                                    @if (\Carbon\Carbon::parse($projeto->data_inicio)->format('Y') == $data)
                                        <li
                                            class="list-group-item tcc-item d-flex justify-content-between align-items-center text-wrap">
                                            <a
                                                href="{{ route('projeto.show', ['id' => $projeto->id]) }}">{{ $projeto->titulo }}</a>

                                            @if (date('Y-m-d') > $projeto->data_termino)
                                                <span class="badge bg-success">Concluído</span>
                                            @else
                                                <span class="badge bg-warning">Não concluído</span>
                                            @endif

                                        </li>
                                    @endif
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
