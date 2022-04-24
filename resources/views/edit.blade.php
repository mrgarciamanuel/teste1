@extends('layouts.userdashboard')
@section('title','Kitunda - Editar produto')
@section('content')
<h1>Editar produtos</h1>
<div>
    <h1>Editando: {{$product->name}} </h1>
    <form action="/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="image">Imagem do Producto:</label>
            <input type="file" name="image" id="image" class="/form-file"><br><br>
        
            <label>Nome:</label>
            <input type="text" name="name" class="/form-control" id="title" placeholder="Nome" value="{{$product->name}}"><br><br>

            <label>Preço:</label>
            <input type="text" name="price" class="/form-control" id="title" placeholder="Preço"><br><br>

            <label>Categoria:</label>
            <input type="text" name="category" class="/form-control" id="title" placeholder="Categoria"><br><br>

            <label>Descrição:</label>
            <input type="text" name="description" class="/form-control" id="title" placeholder="Descrição"><br><br>

            <input type="submit" value="Criar">
        </div>
    </form>
</div>
@endsection