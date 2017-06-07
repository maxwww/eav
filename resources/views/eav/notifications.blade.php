@if ($message = Session::get('message_success'))
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
            <strong>Success</strong> {{ $message }}
        </div>
    </div>
@endif
@if ($message = Session::get('message_failed'))
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
            <strong>Failed</strong> {{ $message }}
        </div>
    </div>
@endif
@if(count($errors) > 0)
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach

            </ul>
        </div>
    </div>
@endif