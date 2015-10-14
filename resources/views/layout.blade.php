<!DOCTYPE html>
<html>
<head>
    <title>Small App</title>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">

</head>
<body class="background-color-@yield('background','white')">
    <div class="container" >
        @yield('header')
        <div class="wrapper" style="margin-top: 5%;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif
                </div>
                <div class="col-md-3"></div>
            </div>

            @yield('content')
        </div>


    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="/js/bootstrap.js"></script>
    @yield('page-scripts')

</body>
</html>

