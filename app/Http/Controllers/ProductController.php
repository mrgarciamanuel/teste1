<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;

class ProductController extends Controller
{
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

        //encontrar o creador do produto: futuramente ligar o produto ao seu criador - ligar a tabela produto com a tabela utilizador
        //$productCreator = User::where('id', $product->user_id)->first()->toArray();

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

    public function cartList(){
        //lista de produtos no carrinho com innerjoin
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
        $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();
        return view ('cartlist',['products'=>$products]);
    }

    public function removeFromCart($id){
        Cart::destroy($id);
        return redirect("/cartlist");
    }

    public function orderNow(){
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
        
        $totPriceCarrinho= $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');//fazer a soma do preço de todos produtos no carrinho
        
        return view ('ordernow',['totPriceCarrinho'=>$totPriceCarrinho]);
    }

    public function store(Request $pedido){
        //instanciação do objeto Product através do Model Product que foi chamado em cima
        $product = new Product;
        
        //atributos do objeto criado
        $product->name = $pedido->name;
        $product->price = $pedido->price;
        $product->category = $pedido->category;
        $product->description = $pedido->description;
        
        //upload da imagem
        if ($pedido->hasFile('image') && $pedido->file('image')->isValid()){
            //encapsular os dados da imagem em numa variável
            $imagePedido = $pedido->image;
            
            //a extensão da imegem vai receber  o atributo extensão do elemento criande em cima
            $extension = $imagePedido->extension();

            //no final o nome da imagem será o nome original + mais tempo atual + a extensão
            //tudo fica dentro do md5 para criar uma rash
            $imageName = md5($imagePedido->getClientOriginalName().strtotime("now")).".".$extension;

            //guardando a imagem no diretorio do projeto
            $pedido->image->move(public_path('img/products'),$imageName);

            $product->image = $imageName;
        }
        
        $product->save();
        
        return redirect ('show');
    }

    public function dashboard(){
        $user = auth()->user();
        return view('dashboard');

    }
}
