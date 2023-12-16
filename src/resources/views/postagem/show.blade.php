@extends('layouts.main')
@section('title', 'Ciência da Computação')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1 text-wrap">{{ $postagem->titulo }}</h1>
                    <div class="text-muted small fst-italic mb-2 text-wrap">Publicado em {{ \Carbon\Carbon::parse($postagem->created_at)->isoFormat('DD [de] MMMM [de] YYYY, HH[h]mm') }} | Última atualização em {{ \Carbon\Carbon::parse($postagem->updated_at)->isoFormat('DD [de] MMMM [de] YYYY, HH[h]mm') }}</div>
                    <div class="badge bg-secondary text-decoration-none link-light text-wrap">{{ $tipo_postagem->nome }}</div>
                </header>

                @if (count($postagem->imagens) > 0 && $postagem->menu_inicial)
                <figure class="mb-4">
                    @php $firstImage = $postagem->imagens[0]; @endphp
                    @if (Storage::disk('public')->exists($firstImage->imagem))
                    <img class="img-fluid rounded" src="{{ URL::asset('storage') }}/{{ $firstImage->imagem }}" alt="{{ $postagem->titulo }}">
                    @endif
                </figure>
                @endif

                <section class="mb-5">
                    <div class="card-text text-wrap">{!! nl2br(str_replace(' ', '&nbsp;', e($postagem->texto))) !!}</div>
                </section>
            </article>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Imagens</div>
                <div class="card-body">
                    @if (count($postagem->imagens) > 0)
                    <div class="row">
                        @foreach ($postagem->imagens as $imagem)
                        @if (Storage::disk('public')->exists($imagem->imagem))
                        <div class="col-4 mb-4">
                            <div class="square-image-container" style="width: 100%; padding-bottom: 100%; position: relative;">
                                <a href="{{ URL::asset('storage') }}/{{ $imagem->imagem }}" target="_blank">
                                    <img class="img-fluid rounded" src="{{ URL::asset('storage') }}/{{ $imagem->imagem }}" alt="{{ $postagem->titulo }}" style="object-fit: cover; position: absolute; width: 100%; height: 100%;">
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div>Nenhuma imagem disponível.</div>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Arquivos</div>
                <div class="card-body">
                    <div class="row">
                        @if (count($postagem->arquivos) > 0)
                        @foreach ($postagem->arquivos as $arquivo)
                        <div class="text-wrap">
                            <a class="text-wrap" href="{{ URL::asset('storage') }}/{{ $arquivo->path }}" target="_blank" title="Arquivo">{{ $arquivo->nome }}</a>
                        </div>
                        @endforeach
                        @else
                        <div>Nenhum arquivo disponível.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection