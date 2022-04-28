@extends('layouts.main')
@section('title','Kitunda - Ver produtos')
@section('content')
<h1>Category product page</h1>

@foreach($products as $product)
    <p>{{$product->name}}</p>
@endforeach

@foreach($categories as $categories)
    <p>{{$category->name}}</p>
@endforeach


@endsection