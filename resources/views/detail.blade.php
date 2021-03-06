@extends('layouts.main')
@section('title','Kitunda - Ver produtos')
@section('content')
<h1>Single product page</h1>

<div class="container">
    <div class="col-sm-6">
        <img src="/img/products/{{$product->image}}" widt="300" height="300" alt="{{$product['name']}}">
        <h1>Nome: {{$product['name']}}</h1>
        <a href="#"><h4>Categoria: {{$product->category->name}}</h4></a>
        <h3>Preço: {{$product['price']}},00 AOA</h3>
        <h4>Peso: 1 kg</h4>
        <h4>Descrição: {{$product['description']}}</h4>
        
        <br>
        <form action="/add_to_favo" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product['id']}}">
            <button>Adicionar aos favoritos</button>
        </form>
        <button>Comprar agora</button>

        <form action="/add_to_cart" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product['id']}}">
            <button>Adicionar ao cesto</button>
        </form>
        
    </div>

    <div class="col-sm-6">
        <a href="/">Voltar</a>
    </div>
</div>

@endsection