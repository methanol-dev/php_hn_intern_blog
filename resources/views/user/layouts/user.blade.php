<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sergey Pozhilov (GetTemplate.com)">

    @yield('title')

    <link rel="shortcut icon" href="{{ asset('bower_components/template_project1/assets/images/gt_favicon.png') }}">

    <!-- Bootstrap -->
    <!-- Bootstrap -->
	<link href="{{ asset('bower_components/template_project1/assets/css/bootstrap.no-icons.min.css') }}" rel="stylesheet">
	<!-- Icons -->
	<link href="{{ asset('bower_components/template_project1/assets/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('bower_components/template_project1/assets/css/font-google.css') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('bower_components/template_project1/assets/css/styles.css') }}">

    <!--[if lt IE 9]> <script src="assets/js/html5shiv.js"></script> <![endif]-->
    @stack('header')
</head>

<body class="home">

    @include('user.partials.header')

    @yield('content')

    @include('user.partials.footer')

    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="{{ asset('bower_components/template_project1/assets/js/ajaxjquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/template_project1/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/template_project1/assets/js/template.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('footer')
</body>

</html>
