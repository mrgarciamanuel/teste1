        <?php
            use App\Http\Controllers\ProductController;
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\DB;

            $user = auth()->user();//verificar autentificação do utilizador
            $userId = $user->id;//variavel userId recebe o identificador do

            //variavel $totPriceCarrinhio recebe a soma em kwanza de todos produtos no carrinho
            $totPriceCarrinhio = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)->sum('products.price');
        ?>
@extends('layouts.main')
@section('title','Kitunda - Carrinho de compras')
@section('content')
<h1>Carrinho de produtos</h1>
<div class="carousel-inner">
    <a href="/ordernow" class="btn btn-primary">Finalizar compra</a><br><br>
    @foreach($products as $product)
    <div class="">
        <a href="detail/{{$product->id}}">
            <img src="/img/products/{{$product->image}}" widt="300" height="300" alt="{{$product->name}}">
            <h3>{{$product->name}}</h3></a>  
            <a href="/remove_from_cart/{{$product->cart_id}}" class="btn btn-danger">Retirar do cesto</a><br><br>          
    </div>
    @endforeach  
    <a href="#">{{$totPriceCarrinhio}}</a><br><br> 
    <a href="/ordernow" class="btn btn-primary">Finalizar compra</a><br><br>    
    </div>
@endsection