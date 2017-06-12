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
            <h1>Create Category</h1>
        </div>

        <br/>

        <div class="form-horizontal">
            {!! Form::open(array('url' => '/admin/categories')) !!}

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" class="form-control input-lg" placeholder="Name"
                           value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <textarea class="form-control input-lg" name="description" id=""
                              rows="5">{{ old('description') ? old('description') : 'Description' }}</textarea>
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
                                    <td><input type="checkbox" name="options[{{ $attribute->id }}]" value="1"></td>
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
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop