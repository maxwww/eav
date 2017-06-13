@extends('eav.layouts.main')


@section('categoriesMenu')
    @include('eav.categoriesMenu')
@stop

@section('content')
    <div class="col-sm-12 col-lg-12 col-md-12">
        {!! Form::open(array('url' => '/cart/submit')) !!}
        <table class="table">
            <tr>
                <td><label for="">Name</label><input type="text" name="name" class="form-control input-lg"
                                                     value="{{ old('name') }}" required></td>
            </tr>
            <tr>
                <td><label for="">Email</label><input type="email" name="email" class="form-control input-lg"
                                                     value="{{ old('email') }}" required></td>
            </tr>
            <tr>
                <td><label for="">Phone</label><input pattern="0\d{9}" type="text" name="phone" class="form-control input-lg"
                                                     value="{{ old('phone') }}" required></td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::to('/js/scripts.js') }}"></script>
    <script src="{{ URL::to('/js/attributes.js') }}"></script>
@stop