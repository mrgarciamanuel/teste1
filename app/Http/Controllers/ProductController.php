<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Form;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;

class ProductController extends Controller
{
    //função que exibe a página de index
    public function index(){
        //chamando todos produtos para a view
        //$products = Product::all();

        //$products = Product::all();
       $products = Product::with('category')->get();//'category' faz referência ao nome da relação que foi criada no model Product

        //mostrar todos produtos que colocamos na variável products
        return view ("welcome",['products'=>$products]);
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

    //função responsável por chamar a página about
    public function about(){
        return view ('about');
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

    function cat_search(Request $pedido){
        //$product = Product::all();
        //if ($product->category_id == $pedido->input('query')){
        //return $pedido->input();
        $product = Product::
        where('category_id','like','%'.$pedido->input('query').'%')
        ->get();
        return view('cat_search',['products'=>$product]);
       // return view ('cat_search',['products'=>$product]);
    
        
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

    //rota que 
    public function orderNow(){
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
        
        $totPriceCarrinho= $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');//fazer a soma do preço de todos produtos no carrinho
        
        return view ('ordernow',['totPriceCarrinho'=>$totPriceCarrinho]);
    }

    //
    public function orderPlace(Request $pedido){
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
        $allCart = Cart::where('user_id',$userId)->get(); //pegando de novo o carrinho cujo id_user seja igual ao id do utilizador

        foreach($allCart as $cart){
            $order = new Order;
            $order->product_id=$cart['product_id'];
            $order->user_id=$cart['user_id'];
            $order->status="Pendente";
            $order->payment_method=$pedido->payment;
            $order->payment_status="Pendente";
            $order->address=$pedido->address;

            $order->save();

            Cart::where('user_id',$userId)->delete();//esvaziando o carrinho depois de afectuada compra
        }
        return redirect("/");
    }

    //rota que permite mostrar as compras feitas por um utilizador
    //para tal, é necessário fazer join entre as tablelas orders e produtos
    public function myOrders(){
        $user = auth()->user();//verificar autentificação do utilizador
        $userId = $user->id;//variavel userId recebe o identificador do
       $orders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->get();

        //return ("Feito");
        return view('myorders',['orders'=>$orders]);

    } 

    public function store(Request $pedido){
        //instanciação do objeto Product através do Model Product que foi chamado em cima
        $product = new Product;
        
        //atributos do objeto criado
        $product->name = $pedido->name;
        $product->price = $pedido->price;
        $product->description = $pedido->description;
        $product->category_id = $pedido->category_id;
        
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

    public function perfil(){
        return view ('perfil');

    }

    public function dashboard(){
        return view ('dashboard');
    }

    public function productlist(){
        $user = auth()->user();
        //$products = $user->products;
        $products = Product::all();
        return view ("productlist",['products'=>$products]); 
    }

    public function destroy($id){
        Product::findOrFail($id)->delete();

        return redirect('productlist')->with('msg', 'Produto excluido');
    }

    public function edit($id){
       $product =  Product::findOrFail($id);
        return redirect('edit',['products'=>$product]);

    }
    
}
