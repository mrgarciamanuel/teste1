@extends('layouts.main')
@section('title','Kitunda - Carrinho de compras')
@section('content')
<h1>Carrinho de produtos</h1>
<div class="carousel-inner">
        @foreach($products as $product)
        <div class="">
            <a href="detail/{{$product->id}}">
                <img src="doce_batata1.jpg" alt="{{$product->name}}">
                <h3>{{$product->name}}</h3>
                <h4>{{$product->category}}</h4>
                <h4>{{$product->price}}</h4>
            </a>
        </div>
        @endforeach       
    </div>
@endsection