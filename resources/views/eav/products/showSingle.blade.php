@extends('eav.layouts.main')

@section('categoriesMenu')
    @include('eav.categoriesMenu')
@stop

@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="page-header">
            <h1>{{ $product->name }}</h1>
        </div>
        <table class="table">
            <tr>
                <td><strong>Category:</strong></td>
                <td><a href="/categories/{{ $product->category->id }}">{{ $product->category->name }}</a></td>
            </tr>
            <tr>
                <td><strong>Description:</strong></td>
                <td>{!! nl2br(htmlspecialchars($product->description)) !!}</td>
            </tr>
            <tr>
                <td><strong>Short Description:</strong></td>
                <td>{!! nl2br(htmlspecialchars($product->s_description)) !!}</td>
            </tr>
            <tr>
                <td><strong>Price:</strong></td>
                <td>${{ $product->price }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>{{ $product->status ? "Available" : "Disable" }}</td>
            </tr>
            <tr>
                <td><strong>Quantity:</strong></td>
                <td>{{ $product->quantity }}</td>
            </tr>
            <td><strong>Image:</strong></td>
            <td><img src="/images/{{ $product->img }}" alt="{{ $product->name }}" class="img-thumbnail"></td>
            </tr>
            @if(count($attributes) > 0)
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->name }}</td>
                        <td>
                            @if($attribute->type == "checkbox")
                                <ul>
                                    @foreach(json_decode($attribute->options, true) as $key => $value)
                                        @if(is_array($params[$attribute->id]) && in_array($key, $params[$attribute->id]))
                                            <li>{{ $value }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @elseif($attribute->type == "text" or $attribute->type == "textarea")
                                {!! nl2br(htmlspecialchars($params[$attribute->id])) !!}
                            @else
                                @if(array_key_exists($params[$attribute->id], json_decode($attribute->options, true)))
                                    {{ (json_decode($attribute->options, true))[$params[$attribute->id]] }}
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@stop

@section('scripts')
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop