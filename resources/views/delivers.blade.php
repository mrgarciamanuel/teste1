@extends('layouts.userdashboard')
@section('title','Kitunda - Ver produtos')
@section('content')

<h1>Delivers Page</h1>

<div class="carousel-inner">
    
    @foreach($delivers as $deliver)
    <div class="">
        <h3>{{$deliver->id}}</h3></a>           
    </div>



    @endforeach  
    
        
    </div>

@endsection