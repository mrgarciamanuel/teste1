<?php

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
Route::get('/', function () {
    return view('welcome');
});
*/
//rota que leva até a página inicial do site
Route::get('/', [ProductController::class, 'index']); 


//rota que leva até a página de criar produtos
Route::get('create', [ProductController::class, 'create']);

//rota que leva até a página de visualizar somente nos produtos
Route::get('show', [ProductController::class, 'show']);

//rota que leva até a página de detalhes de um produto
//as paginas de cada produto serão pegadas pelos seus id
Route::get('detail/{id}', [ProductController::class, 'detail']);

//rota para pesquisa de produtos
Route::get('search', 
[ProductController::class, 'search']);

//rota que adiciona produtos ao cesto
//a rota de adicionar produtos ao cesto só estara disponível 
//para utilizadores logados
Route::post('add_to_cart', 
[ProductController::class, 'addToCart'])->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});