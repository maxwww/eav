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
            <h1>Categories</h1>
            <p class="lead">Create categories and assign them to any object!</p>
            <p><a class="btn btn-lg btn-success" href="{{ URL::to('categories/create') }}" role="button">Add
                    Category</a></p>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categories
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th data-sort="name" class="col-md-3">Category name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <div class="pull-right">
                                                <a class="btn btn-primary tip"
                                                   href="{{ URL::to('categories/' . $category->id) }}" title="View"><i
                                                            class="fa fa-eye"></i></a>
                                                <a class="btn btn-primary tip"
                                                   href="{{ URL::to('categories/' . $category->id . '/edit') }}"
                                                   title="Edit"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger tip" data-toggle="modal"
                                                   data-target="modal-confirm"
                                                   href="{{ URL::to('categories/' . $category->id . '/delete') }}"
                                                   title="Delete"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel panel-default -->
            </div>
            <div class="col-lg-12">
                {{ $categories->render() }}
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
    </div>
@stop

@section('scripts')
    <script src="{{ URL::to('js/scripts.js') }}"></script>
    <script src="{{ URL::to('js/attributes.js') }}"></script>
@stop