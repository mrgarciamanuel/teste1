<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;
class ProductController extends Controller
{
    //
    //função que exibe a página de index
    public function index(){
        //chamando todos produtos para a view
        $products = Product::all();

        //mostrar todos produtos que colocamos na variável products
        return view ("welcome",['products'=>$products]);
    } 

    //função para criação de produtos
    public function create(){
        return view('create');
    }

    //função para visualização de produtos
    public function show(){
        //chamando todos produtos para a view
        //$products = Product::all();

        //mostrar todos produtos que colocamos na variável products
        //return view ("products.show",['products'=>$products]);

        $product = Product::all();
        return view('show', ['products'=>$product]);
        //return view('products.show',['products'=>$products]);
    }

    //função para detalhar determinado produto
    function detail($id){
        $product = Product::find($id);
        return view('detail',['product'=>$product]);
    }

    //função para pesquisa de produtos
    //request foi importado em cima
    function search(Request $pedido){
        //return $pedido->input();
        $product = Product::
        where('name','like','%'.$pedido->input('query').'%')
        ->get();
        return view('search',['products'=>$product]);
    }

    //o request é utilizado sempre que precisamos dados do formulario
    function addToCart(Request $pedido){
        
        $cart = new Cart;
        $user = auth()->user();
        $cart->user_id = $user->id;
        $cart->product_id = $pedido->product_id;
        $cart->save();
        return redirect('show');
    
    }

    static function cartItem(){
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do utilizador
        //retornar o total de vezes de objetos 
        //da classe carinho associados a um determinado utilizador
        return Cart::where('user_id',$userId)->count();

    }
}
