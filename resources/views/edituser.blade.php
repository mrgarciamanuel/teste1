@extends('layouts.userdashboard')
@section('title','Kitunda - Carrinho de compras')
@section('content')

<form action="/edituser/{{$user->id}}" method="post">
    @csrf <!--Cross-site forgeries é um a diretiva do laravel que protege o site de explorações maliciosas através do qual comandos são executados em nome de um utilizador autenticado -->
    @method('PUT')
    <h2>Editar dados de {{$user->name}}</h2>
    <div>
        <label>Nome</label>
        <input type="text" name="name" value="{{$user->name}}">
    </div>

    <div>
        <label>E-mail</label>
        <input type="email" name="email" value="{{$user->email}}">
    </div>

    <div>
        <label>Provincia</label>
        <input type="text" name="province" value="{{$user->province}}">
    </div>

    <div>
        <label>Endereço</label>
        <input type="text" name="address" value="{{$user->morada}}">
    </div>

    <div>
        <label>Telefone</label>
        <input type="text" name="telefone" value="{{$user->telefone}}">
    </div>

    <input type="submit" value="Utualizar">
</form>
@endsection