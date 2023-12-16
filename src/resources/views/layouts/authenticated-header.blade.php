<header class="header-1">
    <div class="container-1">
        <div class="container-1">
            <div class="d-flex justify-content-between align-items-center py-2">
                <div>
                    <span class="fs-6">INSTITUTO FEDERAL DO NORTE DE MINAS GERAIS</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-2">
        <nav class="navbar bg-body-tertiary custom-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('postagem.display') }}">
                    <img src="{{ asset('images/logo-criada.png') }}" alt="Ciência da Computação" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <img src="{{ asset('images/logo-criada.png') }}" alt="Ciência da Computação" class="logo mx-auto">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Postagem
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('postagem.display') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('postagem.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Professor
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('professor.display') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('professor.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tcc
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('tcc.display') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tcc.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Banca
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('banca.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Projeto
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('projetos.view') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('projeto.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Colegiado
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('colegiado.show') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('colegiado.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tipo Postagem
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('tipo-postagem.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Curso
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('curso.sobre') }}">Visualizar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('curso.index') }}">Gerenciar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

</header>