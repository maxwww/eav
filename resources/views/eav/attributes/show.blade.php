@extends('eav.layouts.main')
@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="page-header">
            <h1>{{ $attribute->name }}</h1>
        </div>
        <p><strong>Slug: </strong> {{ $attribute->slug }}</p>
        <p><strong>Type: </strong> {{ $attribute->type }}</p>
        @if($options)
            <p><strong>Options: </strong></p>
            @foreach($options as $key => $value)
                <p>{{ $key }} => {{ $value }}</p>
            @endforeach
        @endif

        <div class="pull-right">
            <a class="btn btn-primary tip"
               href="{{ URL::previous() }}" title="Back"><i
                        class="fa fa-backward"></i></a>
            <a class="btn btn-primary tip"
               href="{{ URL::to('attributes/' . $attribute->id . '/edit') }}"
               title="Edit"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger tip" data-toggle="modal"
               data-target="modal-confirm"
               href="{{ URL::to('attributes/' . $attribute->id . '/delete') }}"
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
@stop