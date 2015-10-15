<!DOCTYPE html>
<html>

<head>
    <title>Small App</title>
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css">
    @yield('page-styles')
</head>

<body class="background-color-@yield('background','white')">

    <div class="container" >

        @yield('header')

        <div class="wrapper" style="margin-top: 10%;">
            @include('partials.alert-box')
            @yield('content')
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>

    @yield('page-scripts')

</body>

</html>

