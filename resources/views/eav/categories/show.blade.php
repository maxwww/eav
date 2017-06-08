@extends('eav.layouts.main')

@section('left')
    <div>
        <p class="lead">Make your choice</p>
        <div class="list-group">
            <a href="{{ URL::to('products') }}" class="list-group-item {{ $active == 'products' ? 'active' : '' }}">Products</a>
            <a href="{{ URL::to('categories') }}" class="list-group-item {{ $active == 'categories' ? 'active' : '' }}">Categories</a>
            <a href="{{ URL::to('attributes') }}" class="list-group-item {{ $active == 'attributes' ? 'active' : '' }}">Attributes</a>
        </div>
    </div>
@stop

@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="page-header">
            <h1>{{ $category->name }}</h1>
        </div>
        <p><strong>Description: </strong></p><p>{!! nl2br(htmlspecialchars($category->description)) !!}</p>
        @if(count($attributes) > 0)
            <p><strong>Attributes: </strong></p>
            <table class="table">
                <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Options</th>
                </tr>
                @foreach($attributes as $attribute)
                    <tr>
                        <td><p>{{ $attribute->name }}</p></td>
                        <td><p>{{ $attribute->type }}</p></td>
                        <td>
                            <ul>
                                @foreach(json_decode($attribute->options, true) as $option)
                                    <li>{{ $option }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif

        <div class="pull-right">
            <a class="btn btn-primary tip"
               href="{{ URL::previous() }}" title="Back"><i
                        class="fa fa-backward"></i></a>
            <a class="btn btn-primary tip"
               href="{{ URL::to('categories/' . $category->id . '/edit') }}"
               title="Edit"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger tip" data-toggle="modal"
               data-target="modal-confirm"
               href="{{ URL::to('categories/' . $category->id . '/delete') }}"
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
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    <script src="{{ URL::to('js/attributes.js') }}"></script>
@stop