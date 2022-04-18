@extends('layouts.main')
@section('title','Kitunda - Ver produtos')
@section('content')

<h1>Lista de produtos</h1>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        @foreach($products as $product)
        <div class="product {{$product['id']==1?'active':''}}">
            <a href="detail/{{$product['id']}}">
                <img src="doce_batata1.jpg" alt="{{$product['name']}}">
                <h3>{{$product['name']}}</h3>
                <h4>{{$product['category']}}</h4>
                <h4>{{$product['price']}}</h4>
                <h5>{{$product['description']}}</h5>
            </a>
        </div>
        @endforeach
    </div>         
@endsection