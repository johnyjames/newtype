<!DOCTYPE html>
<html>
<head>
    <title>Small App</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Cutive">
    <link rel="stylesheet" href="css/app.css">

</head>
<body class="background-color-@yield('background','white')">
    <div class="container">
        @yield('header')

        @yield('content')

    </div>
    @yield('page-scripts')
</body>
</html>

