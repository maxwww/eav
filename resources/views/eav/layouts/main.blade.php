<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EAV model</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::to('css/shop-homepage.css') }}" rel="stylesheet">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ URL::to('css/dd.css') }}" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
@include('eav.navigation')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <div class="row">

                @yield('left')
                @yield('categoriesMenu')
                @yield('cart')


            </div>
        </div>

        <div class="col-md-9">

            @yield('carousel')

            <div class="row">

                @include('eav.notifications')

                @yield('content')

            </div>

        </div>

        @yield('auth')

    </div>

</div>
<!-- /.container -->

<!-- Footer -->
@include('eav.footer')


<!-- /.container -->

<!-- jQuery -->
<script src="{{ URL::to('js/jquery.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ URL::to('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $('.tip').tooltip();
</script>

@yield('scripts')

</body>

</html>