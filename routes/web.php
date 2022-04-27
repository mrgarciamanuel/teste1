<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*

*/
//rota que leva até a página inicial do site
Route::get('/', [ProductController::class, 'index']); 

//rota que adiciona produtos na loja
//a rota de adicionar produtosna loja só estara disponível 
//para utilizadores logados
Route::post('/products', 
[ProductController::class, 'store'])->middleware('auth');

//rota que da acesso a página de criar produtos
Route::get('/create', 
[ProductController::class, 'create'])->middleware('auth');

//rota que leva até a página de visualizar somente nos produtos
Route::get('show', [ProductController::class, 'show']);

//rota que leva até a página de detalhes de um produto
//as paginas de cada produto serão pegadas pelos seus id
Route::get('detail/{id}', [ProductController::class, 'detail']);

//rota para pesquisa de produtos
Route::get('search', 
[ProductController::class, 'search']);

//rora para a página about
Route::get('/about',[ProductController::class,'about']);

//rota para pesquisa de produtos
Route::get('cat_search', 
[ProductController::class, 'cat_search']);

//rota que da acesso a dashboard, só tera acesso a ela os utilizadores logados no sistema
Route::get('/dashboard', [ProductController::class, 'dashboard']);

//rota que da acesso ao admin o acesso aos produtos cadastrados no sistema
Route::get('/productlist', [ProductController::class, 'productlist']);

//rota que da acesso a dashboard, só tera acesso a ela os utilizadores logados no sistema
Route::get('/perfil', [ProductController::class, 'perfil']);

//rota que adiciona produtos ao cesto
//a rota de adicionar produtos ao cesto só estara disponível 
//para utilizadores logados
Route::post('add_to_cart', 
[ProductController::class, 'addToCart'])->middleware('auth');

//rota que permite listar os produtos no carrinho de compras
Route::get('cartlist', 
[ProductController::class, 'cartList']);

//rota que permite remover os produtos no carrinho de compras
Route::get('remove_from_cart/{id}', 
[ProductController::class, 'removeFromCart']);


//rota que permite efectuar compra
Route::get('ordernow',[ProductController::class,'orderNow']);

//rota que epermite finalizar compra
Route::post('orderplace',[ProductController::class,'orderPlace'])->middleware('auth');;

//rota que permite remover os produtos no carrinho de compras
Route::get('myorders', 
[ProductController::class, 'myOrders'])->middleware('auth');;

//rota que permite ao admin deletar produtos
Route::delete('/products/{id}', [ProductController::class,'destroy'])->middleware('auth');;

//rota que permite ao admin deleditar produtos
Route::get('/edit/{id}', [ProductController::class,'edit'])->middleware('auth');;

//rota que permite contacto
Route::get('/contact',[FormController::class,'contact']);

Route::post('/contact', 
[FormController::class, 'store']);
/*
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
*/
