<table class="table">
    <tr>
        <td>
            Product
        </td>
        <td>
            Price
        </td>
        <td>
            Quantity
        </td>
        <td>
            Remove
        </td>
    </tr>
    @foreach($items as $id => $item)
        <tr>
            <td>
                <a href="{{ URL::to('/products/' . $id) }}">{{ $item['name'] }}</a>
            </td>
            <td>{{ $item['price'] }}</td>
            <td>{{ $item['count'] }}</td>
            <td><button data-remove="{{ $id }}" type="button" class="btn btn-danger">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </button></td>
        </tr>
    @endforeach
    <tr>
        <td>Total</td>
        <td>{{ session('cart.total') }}</td>
        <td><a href="{{ URL::to('/cart/checkout') }}" type="button" class="btn btn-success">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>Buy
            </a></td>
        <td><button data-remove="all" type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>All
            </button></td>
    </tr>
</table>