<header id="header">

    <nav class="navbar navbar-default navbar-sticky">
        <div class="container-fluid">

            <div class="navbar-collapse collapse">
                @if (Route::has('login'))
                @auth
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">{{ trans('me.home') }}</a></li>
                    <li><a href="#">{{ trans('me.create') }}</a></li>
                    <li><a href="{{ route('language', ['lang' => 'vi']) }}">VI</a></li>
                    <li><a href="{{ route('language', ['lang' => 'en']) }}">EN</a></li>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{-- <img src="{{ asset('storage/user/'. Auth::User()->avatar) }}" alt=""> --}}
                                {{ Auth::user()->username }}
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
                        <input type="search" class="form-control rounded" placeholder="{{ trans('me.search') }}"
                            aria-label="Search" aria-describedby="search-addon" />
                    </li>
                    <li>
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
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
                        <input type="search" class="form-control rounded" placeholder="{{ trans('me.search') }}"
                            aria-label="Search" aria-describedby="search-addon" />
                    </li>
                    <li>
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </li>
                </ul>
                @endauth
            </div>
            @endif
        </div>
        </div>
    </nav>
</header>
