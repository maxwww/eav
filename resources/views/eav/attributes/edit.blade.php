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
            <h1>Update Attribute: {{ $attribute->name }}</h1>
        </div>

        <br/>

        <div class="form-horizontal">
            {!! Form::open(array('url' => '/admin/attributes/' . $attribute->id . '/update')) !!}
            <div class="form-group">
                <div class="col-xs-6">
                    <input type="text" name="name" class="form-control input-lg" placeholder="Name"
                           value="{{ old('name') ? old('name') : $attribute->name }}" required>
                </div>

                <div class="col-xs-6">
                    <input type="text" name="slug" class="form-control input-lg" placeholder="Slug"
                           value="{{ old('slug') ? old('slug') : $attribute->slug }}" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <select name="type" id="type" class="form-control input-lg" required>
                        <option data-allow-options="0" value="">Select Type</option>
                        <option data-allow-options="0" value="text" {{ $attribute->type == 'text' ? "selected": "" }}>
                            Text
                        </option>
                        <option data-allow-options="1"
                                value="checkbox" {{ $attribute->type == 'checkbox' ? "selected": "" }}>Checkbox
                        </option>
                        <option data-allow-options="1"
                                value="select" {{ $attribute->type == 'select' ? "selected": "" }}>Select
                        </option>
                        <option data-allow-options="1" value="radio" {{ $attribute->type == 'radio' ? "selected": "" }}>
                            Radio
                        </option>
                        <option data-allow-options="0"
                                value="textarea" {{ $attribute->type == 'textarea' ? "selected": "" }}>Textarea
                        </option>
                    </select>
                </div>
            </div>

            <div class="hide" data-options>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th style="width:40%;">Key</th>
                        <th style="width:40%;">Value</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr data-option-clone class="hide">
                        <td><input class="form-control" name="options[0][key]" type="text"></td>
                        <td><input class="form-control" name="options[0][value]" type="text"></td>
                        <td><span data-option-remove class="btn btn-danger btn-sm">Remove</span></td>
                    </tr>
                    <tr data-options-empty>
                        <td colspan="4">There are no options.</td>
                    </tr>

                    @if($options && count($options) > 0)
                        @php
                            $i=3
                        @endphp
                        @foreach($options as $key =>$value)
                            <tr class="">
                                <td><input class="form-control" name="options[{{ $i }}][key]" type="text"
                                           value="{{ $key }}" required=""></td>
                                <td><input class="form-control" name="options[{{ $i }}][value]" type="text"
                                           value="{{ $value }}" required=""></td>
                                <td><span data-option-remove="" class="btn btn-danger btn-sm">Remove</span></td>
                            </tr>
                            @php
                                $i++
                            @endphp
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td><span data-option-add class="btn btn-info btn-sm">Add Option</span></td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="hide" data-no-options>
                <div class="jumbotron">
                    <h4 class="text-center">The selected attribute type, doesn't allow options.</h4>
                </div>
            </div>


            <div class="form-group">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-success tip" title="Save">Save</button>
                    <a class="btn btn-info tip" href="{{ URL::to('/admin/attributes') }}" title="Back">Back</a>
                    <a class="btn btn-danger tip" data-toggle="modal"
                       data-target="modal-confirm"
                       href="{{ URL::to('/admin/attributes/' . $attribute->id . '/delete') }}"
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
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop