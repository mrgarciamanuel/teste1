@extends('layouts.main')
@section('title','Kitunda')
@section('content')


@foreach($products as $product)
    <p>Garcia</p>
    <p>{{$product->name}} -- {{$product->description}}</p>
@endforeach
@endsection