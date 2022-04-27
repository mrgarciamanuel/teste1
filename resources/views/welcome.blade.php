@extends('layouts.main')
@section('title','Kitunda')
@section('content')

<h1>CONSTRUINDO OPORTUNIDADES ALÉM FRONTEIRAS</h1>

@foreach($products as $product)
    <a href="detail/{{$product['id']}}">
        <img src="/img/products/{{$product->image}}" widt="300" height="300" alt="{{$product['name']}}">
    <h3>{{$product->name}}</h3></a>
    <p>{{$product->description}}</p></a>
    <h4>Categoria: {{$product->category->name}}</h4>
    <a href="#">Adicionar aos favoritos</a><br>
    <a href="#">Comentar</a><br><br>

    <form action="/add_to_cart" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <button class="btn btn-primary" >Adicionar ao cesto</button>
    </form>
    <a class="btn btn-primary" href="detail/{{$product['id']}}">Ver detalhes</a><br><br>
    <hr>
@endforeach
@endsection