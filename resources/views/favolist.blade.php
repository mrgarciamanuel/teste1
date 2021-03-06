@extends('layouts.main')
@section('title','Kitunda - Carrinho de compras')
@section('content')
<h1>Seus produtos favoritos</h1>
<div class="carousel-inner">
    @foreach($products as $product)
    <div class="">
        <a href="detail/{{$product->id}}">
            <img src="/img/products/{{$product->image}}" widt="300" height="300" alt="{{$product->name}}">
            <h3>{{$product->name}}</h3>
        </a>   
        <a class="btn btn-primary" href="detail/{{$product->id}}">Ver detalhes</a><br><br>        
    </div>
    @endforeach 
</div>

@endsection