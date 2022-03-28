<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button class="dropdown-item" id="en"><a href="/lang/en">EN</a></button>
        <li class="nav-item">
            <button class="dropdown-item" id="vi"><a href="/lang/vi">VI</a></button>
        </li>
        <li class="nav-item">
            <button class="dropdown-item" id="logout">{{ trans('me.logout') }}</button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
