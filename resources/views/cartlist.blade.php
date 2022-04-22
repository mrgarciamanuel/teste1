@extends('layouts.main')
@section('title','Kitunda - Carrinho de compras')
@section('content')
<h1>Carrinho de produtos</h1>
<div class="carousel-inner">
        @foreach($products as $product)
        <div class="">
            <a href="detail/{{$product->id}}">
                <img src="/img/products/{{$product->image}}" alt="{{$product->name}}">
                <h3>{{$product->name}}</h3></a>  
                <a href="/remove_from_cart/{{$product->cart_id}}">Retirar do cesto</a><br><br>          
        </div>
        @endforeach       
    </div>
@endsection