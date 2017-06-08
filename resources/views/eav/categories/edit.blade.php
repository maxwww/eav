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
            <h1>Update Category: {{ $category->name }}</h1>
        </div>

        <br/>

        <div class="form-horizontal">
            {!! Form::open(array('url' => '/categories/' . $category->id . '/update')) !!}

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" class="form-control input-lg" placeholder="Name"
                           value="{{ old('name') ? old('name') : $category->name }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <textarea class="form-control input-lg" name="description" id=""
                              rows="5">{{ old('description') ? old('description') : $category->description }}</textarea>
                </div>
            </div>

            @if(count($attributes) > 0)
                <div class="form-group">
                    <div class="col-xs-12">Attributes:</div>
                    <div class="col-xs-12">
                        <table class="table">
                            <tr>
                                <th><span class="glyphicon glyphicon-check"></span></th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Options</th>
                            </tr>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td><input type="checkbox" name="options[{{ $attribute->id }}]" value="1" {{ in_array($attribute->id, $category->attributes) ? "checked" : "" }}></td>
                                    <td>{{ $attribute->name }}</td>
                                    <td>{{ $attribute->type }}</td>
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
                    </div>
                </div>
            @endif

            <div class="form-group">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success tip" title="Save">Save</button>
                    <a class="btn btn-info tip" href="{{ URL::to('categories') }}" title="Back">Back</a>
                    <a class="btn btn-danger tip" data-toggle="modal"
                       data-target="modal-confirm"
                       href="{{ URL::to('categories/' . $attribute->id . '/delete') }}"
                       title="Delete">Delete</a>
                </div>
            </div>
            {!! Form::close() !!}

        </div>


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

@stop

@section('scripts')
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    <script src="{{ URL::to('js/attributes.js') }}"></script>
@stop