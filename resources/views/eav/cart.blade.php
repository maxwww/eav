@extends('eav.layouts.main')


@section('categoriesMenu')
    @include('eav.categoriesMenu')
@stop

@section('content')
    {!! Form::open(array('url' => '/admin/categories')) !!}
    <div class="col-sm-12 col-lg-12 col-md-12">
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
                    <td><button type="button" class="btn btn-danger">
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
                <td><button type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>All
                    </button></td>
            </tr>
        </table>
    </div>
    {!! Form::close() !!}
@endsection