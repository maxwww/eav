@extends('eav.layouts.main')

@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="thumbnail">

            @foreach($products as $product)
                {{ $product->name }} => {{ dump($product->category) }}
            @endforeach

            <hr/>
            @foreach($categories as $category)
                {{ $category->name }} => {{ dump($category->products) }}
            @endforeach

        </div>
    </div>
@stop