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
                    <ul class="navbar-nav">                    
                        @auth
                            <li class="nav-item">
                                <a href="/perfil" class="nav-link">Meu Perfil</a>
                            </li>

                            <li class="nav-item">
                                <a href="/myorders" class="nav-link">Minhas compras</a>
                            </li>                         
                            
                            @if($user->id==1)
                                <li class="nav-item">
                                    <a href="/productlist" class="nav-link">Produtos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/create" class="nav-link">Criar produtos</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a href="/" class="nav-link">Acesso a loja</a>
                            </li>  
                            
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
                        </ul>
                </div>
            </nav>
        </header>   
    @yield('content')
    <footer>
        <p>Kitunda &copy; 2022</p>
    </footer>
    </body>
</html>