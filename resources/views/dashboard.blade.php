@extends('layouts.userdashboard')
@section('title','Kitunda - Ver produtos')
@section('content')
<h1>Página de perfil do utilizador</h1>

<p>{{$user->name}}</p>
<p>{{$user->email}}</p>
<p>{{$user->email}}</p>

<a href="edituser/{{$user->id}}">Editar dados</a>

@endsection