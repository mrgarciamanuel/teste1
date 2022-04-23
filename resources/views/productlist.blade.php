@extends('layouts.userdashboard')
@section('title','Kitunda - User dashboard')
@section('content')
<h1>Produtos da loja</h1>

@if(count($products)>0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Preco</th>
                <th scope="col">Categoria</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach($products as $product)
            <tr>
                <td scropt="row">{{$loop->index +1}}</td> 
                <td><a href="/products/{{$product->id}}">{{$product->name}}</a></td>
                <td><a href="/products/{{$product->price}}">{{$product->price}}</a></td>
                <td><a href="/products/{{$product->category}}">{{$product->category}}</a></td>
                <td><a href="#">Editar</a><a href="#">Deletar</a></td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
@else
@endif

@endsection
