@foreach($products as $product)
    <a href="detail/{{$product['id']}}">
        <img src="/img/products/{{$product->image}}" alt="{{$product['name']}}">


    <form action="/add_to_cart" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{$product['id']}}">
        <button>Adicionar ao cesto</button>
    </form>
  
@endforeach