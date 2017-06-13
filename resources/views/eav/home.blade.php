@extends('eav.layouts.main')


@section('categoriesMenu')
    @include('eav.categoriesMenu')
@stop

@section('carousel')
    @include('eav.carousel')
@stop

@section('content')
    @foreach($products as $product)
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src="{{ URL::to('/images/'.$product->img) }}" alt="">
                <div class="caption">
                    <h4 class="pull-right">${{ $product->price }}</h4>
                    <h4><a href="{{ URL::to('/products/'.$product->id) }}">{{ $product->name }}</a>
                    </h4>
                    <p>{{ $product->s_description }}</p>
                </div>
                <button data-add-to-cart="{{ $product->id }}" class="add-cart-large">Add To Cart</button>
            </div>
        </div>
    @endforeach
@stop

@section('scripts')
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop