@extends('layouts.main')
@section('title','Kitunda - Ver produtos')
@section('content')

    <div>
        <div>
            <h1>Pesquisa de produtos</h1>
            @foreach($products as $product)
            <div>
                <a href="detail/{{$product['id']}}">
                    <img src="{{$product['gallery']}}">
                    <div>
                        <h2>{{$product['name']}}</h2>
                        <h5>{{$product['description']}}</h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

@endsection