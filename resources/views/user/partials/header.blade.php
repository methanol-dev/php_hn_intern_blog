<header id="header">

    <nav class="navbar navbar-default navbar-sticky">
        <div class="container-fluid">

            <div class="navbar-collapse collapse">
                @if (Route::has('login'))
                @auth
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">{{ trans('me.home') }}</a></li>
                    <li><a href="{{ route('post.create') }}">{{ trans('me.create') }}</a></li>
                    <li><a href="{{ route('post.index') }}">{{ trans('me.post') }}</a></li>
                    <li><a href="{{ route('language', ['lang' => 'vi']) }}">VI</a></li>
                    <li><a href="{{ route('language', ['lang' => 'en']) }}">EN</a></li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{-- <img src="{{ asset('storage/user/'. Auth::User()->avatar) }}" alt=""> --}}
                                {{ Auth::user()->full_name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">{{
                                    trans('me.profile') }}</a>
                                <button id="logout">{{ trans('me.logout') }}</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    <li>
                        <form class="form-inline" action="{{ route('search') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="search" class="sr-only">{{ trans('me.search') }}</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="{{ trans('me.search') }}">
                            </div>
                            <button type="submit" class="btn mb-2 btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
                @else
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">{{ trans('me.home') }}</a></li>
                    <li><a href="{{ route('language', ['lang' => 'vi']) }}">VI</a></li>
                    <li><a href="{{ route('language', ['lang' => 'en']) }}">EN</a></li>
                    <li class="active"><a href="{{ route('login') }}">{{ trans('me.login') }}</a></li>
                    <li class="active"><a href="{{ route('register') }}">{{ trans('me.register') }}</a></li>
                    <li>
                        <form class="form-inline" action="{{ route('search') }}" method="GET">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="search" class="sr-only">{{ trans('me.search') }}</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="{{ trans('me.search') }}">
                            </div>
                            <button type="submit" class="btn mb-2 btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>
                </ul>
                @endauth
            </div>
            @endif
        </div>
        </div>
    </nav>
</header>
