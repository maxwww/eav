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
            <h1>Create Product</h1>
        </div>

        <br/>

        <div class="form-horizontal">
            {!! Form::open(array('url' => '/products', 'files' => true, 'enctype' => 'multipart/form-data')) !!}

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

            <div class="form-group">
                <div class="col-xs-12">
                    <textarea class="form-control input-lg" name="s_description" id=""
                              rows="3">{{ old('description') ? old('s_description') : 'Short Description' }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    Image: <input type="file" name="img" class="form-control input-lg" value="{{old('img')}}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-4">
                    <select name="status" class="form-control input-lg" required="">
                        <option value="1">Available</option>
                        <option value="0">Disable</option>
                    </select>
                </div>

                <div class="col-xs-4">
                    <input type="text" name="quantity" class="form-control input-lg" placeholder="Quantity"
                           value="{{ old('quantity') }}" required>
                </div>

                <div class="col-xs-4">
                    <input type="text" name="price" class="form-control input-lg" placeholder="Price"
                           value="{{ old('price') }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <select id="select_category" name="category_id" class="form-control input-lg" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="params">

            </div>


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
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    <script src="{{ URL::to('js/attributes.js') }}"></script>
@stop