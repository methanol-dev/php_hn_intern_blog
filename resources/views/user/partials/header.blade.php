<header id="header">

    <nav class="navbar navbar-default navbar-sticky">
        <div class="container-fluid">

            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">{{ trans('me.home') }}</a></li>
                    <li><a href="#">{{ trans('me.create') }}</a></li>
                    <li><a href="#">{{ trans('me.login') }}</a></li>
                    <li><a href="#">{{ trans('me.register') }}</a></li>
                    <li><a href="{{ route('language', ['lang' => 'vi']) }}">VI</a></li>
                    <li><a href="{{ route('language', ['lang' => 'en']) }}">EN</a></li>
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

            </div>
        </div>
    </nav>
</header>
