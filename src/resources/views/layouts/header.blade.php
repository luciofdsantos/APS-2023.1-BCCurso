<header class="header-1">
    <div class="container-1">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div>
                <span class="fs-6">INSTITUTO FEDERAL DO NORTE DE MINAS GERAIS</span>
            </div>
            <div>
                <a href="{{ route('login') }}" class="text-white text-decoration-none me-2">Login</a>
            </div>
        </div>
    </div>

    <div class="container-2">
        <nav class="navbar navbar-expand-lg bg-white custom-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('postagem.display') }}">
                    <img src="{{ asset('images/logo-criada.png') }}" alt="Ciência da Computação" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse custom-navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('curso.show', ['id' => '1']) }}">Sobre o curso</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('postagem.display') }}">Notícias</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('professor.display') }}">Professores</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tcc.display') }}">TCC</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('projetos.view') }}">Projeto</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('colegiado.show') }}">Colegiado</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</header>
