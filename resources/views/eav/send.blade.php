<html>
<head></head>
<body style="background: black; color: white">
<h1>New Order from {{ $input['name'] }}</h1>
<p>Mail: {{ $input['email'] }}</p>
<p>Phone: {{ $input['phone'] }}</p>
<p>Items</p>
@foreach($items as $key => $item)
    <p>Product id={{ $key }} | price={{ $item['price'] }} | quantity={{ $item['count'] }}</p>
@endforeach
<br>
<p>Total = {{ session('cart.total') }}</p>
</body>
</html>