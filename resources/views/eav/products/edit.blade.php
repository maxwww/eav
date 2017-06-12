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
            <h1>Update Product</h1>
        </div>

        <br/>

        <div class="form-horizontal">
            {!! Form::open(array('url' => '/admin/products/' . $product->id . '/update', 'files' => true, 'enctype' => 'multipart/form-data')) !!}

            <div class="form-group">
                <div class="col-xs-12">
                    <input type="text" name="name" class="form-control input-lg" placeholder="Name"
                           value="{{ old('name') ? old('name') : $product->name }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <textarea class="form-control input-lg" name="description"
                              rows="5">{{ old('description') ? old('description') : $product->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <textarea class="form-control input-lg" name="s_description" id=""
                              rows="3">{{ old('s_description') ? old('s_description') : $product->s_description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label>New Image. Old Image will be deleted!!!</label>
                    <input id="image-input" type="file" name="img" class="form-control input-lg" value="{{old('img')}}">
                    <div id="image-img">
                        <img src="/images/{{ $product->img }}" alt="{{ $product->name }}" class="img-thumbnail">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-4">
                    <label>Status:</label>
                    <select name="status" class="form-control input-lg" required="">
                        <option value="1" {{ $product->status == 1 ? "selected" : "" }}>Available</option>
                        <option value="0" {{ $product->status == 0 ? "selected" : "" }}>Disable</option>
                    </select>
                </div>

                <div class="col-xs-4">
                    <label>Quantity:</label>
                    <input type="text" name="quantity" class="form-control input-lg" placeholder="Quantity"
                           value="{{ old('quantity') ? old('quantity') : $product->quantity }}" required>
                </div>

                <div class="col-xs-4">
                    <label>Price:</label>
                    <input type="text" name="price" class="form-control input-lg" placeholder="Price"
                           value="{{ old('price') ? old('price') : $product->price }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <select id="select_category" name="category_id" class="form-control input-lg" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="params">
                @foreach($attributes as $key => $attribute)
                    @if($attribute->type == 'text')
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label for="params[{{ $attribute->id }}]">{{ $attribute->name }}:</label>
                                <input type="text" name="params[{{ $attribute->id }}]"
                                       value="{{ isset($params[$attribute->id]) ? $params[$attribute->id] : "" }}"
                                       class="form-control input-lg">
                            </div>
                        </div>
                    @elseif($attribute->type == 'checkbox')
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>{{ $attribute->name }}:</label>
                                @foreach(json_decode($attribute->options, true) as $key => $option)
                                    <div class="col-xs-12">
                                        <input type="checkbox" name="params[{{ $attribute->id }}][]"
                                               value="{{ $key }}" {{ isset($params[$attribute->id]) && in_array($key, $params[$attribute->id]) ? "checked" : "" }}> {{ $option }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($attribute->type == 'radio')
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>{{ $attribute->name }}:</label>
                                @foreach(json_decode($attribute->options, true) as $key => $option)
                                    <div class="col-xs-12">
                                        <input type="radio" name="params[{{ $attribute->id }}]"
                                               value="{{ $key }}" {{ isset($params[$attribute->id]) && $key == $params[$attribute->id] ? "checked" : "" }}> {{ $option }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($attribute->type == 'select')
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>{{ $attribute->name }}:</label>
                                <select name="params[{{ $attribute->id }}]" class="form-control input-lg" required="">
                                    @foreach(json_decode($attribute->options, true) as $key => $option)
                                        <option value="{{ $key }}" {{ isset($params[$attribute->id]) && $key == $params[$attribute->id] ? "selected" : "" }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @elseif($attribute->type == 'textarea')
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>{{ $attribute->name }}:</label>
                                <textarea class="form-control input-lg" name="params[{{ $attribute->id }}]"
                                          rows="5">{{ $params[$attribute->id] }}</textarea>
                            </div>
                        </div>
                    @endif
                @endforeach
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
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop