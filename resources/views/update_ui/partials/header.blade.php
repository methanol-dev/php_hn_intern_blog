<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img
                    src="{{ asset('bower_components/tech_blog_template/images/version/tech-logo.png') }}" alt=""></a>
            @if (Auth::check())
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ trans('me.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.index') }}">{{ trans('me.post') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('post.create') }}">{{ trans('me.create') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('language', ['lang' => 'vi']) }}">VI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{  route('language', ['lang' => 'en']) }}">EN</i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <span class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-user"></i></span>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile') }}">{{ trans('me.profile') }}</a></li>
                            <li><a id="logout">{{ trans('me.logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @else
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ trans('me.home') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-2" id="mr-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('language', ['lang' => 'vi']) }}">VI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{  route('language', ['lang' => 'en']) }}">EN</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ trans('me.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ trans('me.register') }}</a>
                    </li>
                </ul>
            </div>
            @endif
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->
