@extends('layouts.main')
@section('title','Kitunda')
@section('content')

<h1>CONSTRUINDO OPORTUNIDADES ALÉM FRONTEIRAS</h1>

@foreach($products as $product)
    <a href="detail/{{$product['id']}}">
        <img src="/img/products/{{$product->image}}" alt="{{$product['name']}}">
    <p>{{$product->name}}</p></a>
    <p>{{$product->price}},00 AOA </p>

    <form action="/add_to_cart" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <button>Adicionar ao cesto</button>
    </form>
    <button>Comprar agora</button><br><br>
@endforeach
@endsection