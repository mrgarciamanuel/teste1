<?php
    use App\Http\Controllers\ProductController;
    use Illuminate\Support\Facades\Auth;
    //se o utilizador não estiver autenticado, 
    //o carrinho estará sempre zerado 
    $total = 0;

    //se o utilizador estiver logado, será exibido o
    //número de produtos no carrinho
    if ($user = auth()->user()){
    $total = ProductController::cartItem();
    }
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield ('title')</title>
        <link rel="stylesheet" href="/css/estilo.css">
       
    </head>
    <body class="antialiased">
        
        <header>
            <nav class="navbar navbar-expand-lg navbar-loght">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="/img/logo.png" alt="Kitunda Store">
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/show" class="nav-link">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/create" class="nav-link">Criar produtos</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/cartlist" class="nav-link">Carinho({{$total}})</a>
                        </li>
                    
                        @auth
                        <li class="nav-item">
                            <a href="/perfil" class="nav-link">User dashboard</a>
                        </li>

                        <!--<li class="nav-item">
                            <a href="/myorders" class="nav-link">Compras</a>
                        </li>-->

                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" 
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Sair
                            </a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                        
                    </ul>
                    <!-- @auth
                        @if($user->id==1)
                            <li class="nav-item">
                                <a href="/show" class="nav-link">Admin</a>
                            </li>
                        @endif
                    @endauth 
                -->
                    <!--Formulário que fez pesquisa de produtos 
                    do utilizador-->
                    <form action="search">
                        <div>
                            <input type="text" name="query" class="" placeholder="Pesquise por um produto">
                            <button type="submit" class="btn btn-default">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </nav>
        </header>   
    @yield('content')
    <footer>
        <p>Kitunda &copy; 2022</p>
    </footer>
    </body>
</html>
