@extends('layouts.main')
@section('title','Kitunda')
@section('content')


@foreach($products as $product)
    <p>{{$product->name}} -- {{$product->description}}</p>
@endforeach
@endsection