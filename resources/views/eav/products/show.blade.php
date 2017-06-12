@extends('eav.layouts.main')

@section('left')
    <div>
        <p class="lead">Make your choice</p>
        <div class="list-group">
            <a href="{{ URL::to('/admin/products') }}" class="list-group-item {{ $active == 'products' ? 'active' : '' }}">Products</a>
            <a href="{{ URL::to('/admin/categories') }}" class="list-group-item {{ $active == 'categories' ? 'active' : '' }}">Categories</a>
            <a href="{{ URL::to('/admin/attributes') }}" class="list-group-item {{ $active == 'attributes' ? 'active' : '' }}">Attributes</a>
        </div>
    </div>
@stop

@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="page-header">
            <h1>{{ $product->name }}</h1>
        </div>
        <table class="table">
            <tr>
                <td><strong>Category:</strong></td>
                <td><a href="/admin/categories/{{ $product->category->id }}">{{ $product->category->name }}</a></td>
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

        <div class="pull-right">
            <a class="btn btn-primary tip"
               href="{{ URL::previous() }}" title="Back"><i
                        class="fa fa-backward"></i></a>
            <a class="btn btn-primary tip"
               href="{{ URL::to('/admin/products/' . $product->id . '/edit') }}"
               title="Edit"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger tip" data-toggle="modal"
               data-target="modal-confirm"
               href="{{ URL::to('/admin/products/' . $product->id . '/delete') }}"
               title="Delete"><i class="fa fa-trash-o"></i></a>
        </div>
        <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="model-confirm-label"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Delete</h4>
                    </div>

                    <div class="modal-body">
                        <p class="text-center">Are you sure want to delete this attribute?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn btn-danger confirm">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop