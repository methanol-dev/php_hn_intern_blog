<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('me.bower_components/tech_blog_template/profile') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('bower_components/tech_blog_template/profile/apple-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('bower_components/tech_blog_template/profile/favicon.ico') }}">

    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet"
        href="{{ asset('bower_components/tech_blog_template/profile/vendors/jqvmap/dist/jqvmap.min.css') }}">


    <link rel="stylesheet" href="{{ asset('bower_components/tech_blog_template/profile/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <div class="header-left">
                        <a href="{{ route('home') }}">{{ trans('me.home') }}</a>
                    </div>
                </div>

                <div class="col-sm-5">

                </div>
            </div>

        </header>

        <div class="content mt-3">
            <div class="row">

                <div class="col-8 mx-auto">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">{{ trans('me.profile') }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block"
                                        src="{{ asset('storage/user/'. Auth::user()->avatar) }}" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1">{{ trans('me.full_name') }}{{ ': ' . Auth::user()->full_name }}</h5>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('me.action') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="default-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                            <a class="nav-item nav-link active show" id="nav-profile-tab" data-toggle="tab"
                                                href="#nav-profile" role="tab" aria-controls="nav-profile"
                                                aria-selected="true">{{ trans('me.profile') }}</a>
                                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                                href="#nav-contact" role="tab" aria-controls="nav-contact"
                                                aria-selected="false">{{ trans('me.change_password') }}</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">

                                        <div class="tab-pane fade active show" id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data"
                                                class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label
                                                            class=" form-control-label">{{ trans('me.email') }}</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <p class="form-control-static">{{ Auth::user()->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="first_name"
                                                            class=" form-control-label">{{ trans('me.first_name') }}</label></div>
                                                    <div class="col-12 col-md-9"><input type="text" id="first_name"
                                                            name="first_name" placeholder="first_name" class="form-control"
                                                            value="{{ Auth::user()->first_name }}">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="last_name"
                                                            class=" form-control-label">{{ trans('me.last_name') }}</label></div>
                                                    <div class="col-12 col-md-9"><input type="text" id="last_name" name="last_name"
                                                            placeholder="last_name" class="form-control"
                                                            value="{{ Auth::user()->last_name }}"></div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="avatar"
                                                            class=" form-control-label">{{ trans('me.avatar') }}</label></div>
                                                    <div class="col-12 col-md-9"><input type="file" id="avatar" name="avatar"
                                                            class="form-control-file"></div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                                    <i class="fa fa-dot-circle-o"></i>{{ trans('me.submit') }}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">
                                            <form action="{{ route('changePassword') }}" method="post" enctype="multipart/form-data"
                                                class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="old_password"
                                                            class=" form-control-label">{{ trans('me.old_password') }}
                                                        </label></div>
                                                    <div class="col-12 col-md-9"><input type="password" id="old_password"
                                                            name="old_password" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="password"
                                                            class=" form-control-label">{{ trans('me.new_password') }}
                                                        </label></div>
                                                    <div class="col-12 col-md-9"><input type="password" id="password"
                                                            name="password" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="password_confirmation"
                                                            class=" form-control-label">{{ trans('me.confirm_password') }}
                                                        </label></div>
                                                    <div class="col-12 col-md-9"><input type="password"
                                                            id="password_confirmation" name="password_confirmation"
                                                            placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm float-right">
                                                    <i class="fa fa-dot-circle-o"></i>{{ trans('me.submit') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div> <!-- .content -->
        <!-- .content -->
    </div><!-- /#right-panel -->

    <script src="{{ asset('bower_components/tech_blog_template/profile/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/vendors/popper.js/dist/umd/popper.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/vendors/bootstrap/dist/js/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/assets/js/main.js') }}"></script>


    <script src="{{ asset('bower_components/tech_blog_template/profile/vendors/chart.js/dist/Chart.bundle.min.js') }}">
    </script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('bower_components/tech_blog_template/profile/vendors/jqvmap/dist/jquery.vmap.min.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/tech_blog_template/profile/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}">
    </script>
    <script
        src="{{ asset('bower_components/tech_blog_template/profile/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}">
    </script>
</body>

</html>
