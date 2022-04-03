<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>Tech Blog - Stylish Magazine Blog Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="{{ asset('bower_components/tech_blog_template/css/bootstrap.css') }}" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="{{ asset('bower_components/tech_blog_template/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('bower_components/tech_blog_template/style.css') }}" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="{{ asset('bower_components/tech_blog_template/css/responsive.css') }}" rel="stylesheet">

<!-- Colors for this template -->
<link href="{{ asset('bower_components/tech_blog_template/css/colors.css') }}" rel="stylesheet">

<!-- Version Tech CSS for this template -->
<link href="{{ asset('bower_components/tech_blog_template/css/version/tech.css') }}" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
@stack('header')
</head>

<body>

    <div id="wrapper">

        @include('update_ui.partials.header')

        @yield('content')

        @include('update_ui.partials.footer')

    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="{{ asset('bower_components/tech_blog_template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/js/tether.min.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/js/custom.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('footer')

</body>

</html>
