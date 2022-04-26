@extends('layouts.main')
@section('title','Kitunda - Ver produtos')
@section('content')

<h1>Lista de produtos</h1>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach($products as $product)
        <div class="product {{$product['id']==1?'active':''}}">
            <a href="detail/{{$product['id']}}">
                <img src="/img/products/{{$product->image}}" alt="{{$product['name']}}">
                <h3>{{$product['name']}}</h3></a>
                <h4>Categoria: {{$product->category->name}}</h4>
                <h4>{{$product['price']}},00 AOA </h4>
                <h5>{{$product['description']}}</h5> 
                
                
                <form action="/add_to_cart" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                    <button>Adicionar ao cesto</button>
                </form>
                <button>Comprar agora</button><br><br>
        </div>
        @endforeach
    </div>         
@endsection