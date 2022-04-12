@extends('layouts.app')

@section('title')
    <title>{{ trans('me.login') }}</title>
@endsection

@section('content')
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png" alt="IMG">
            </div>

            <form class="login100-form" action="{{ route('login') }}" method="POST">
                @csrf
                @method('POST')
                <span class="login100-form-title">
                    {{ trans('me.member_login') }}
                </span>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="email" placeholder="{{ trans('me.email') }}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100">
                    <input class="input100" type="password" name="password" placeholder="{{ trans('me.password') }}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ trans('me.login') }}
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <a class="txt2" href="{{ route('password.request') }}">
                        {{ trans('me.forgot_password') }}
                    </a>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="{{ route('register') }}">
                        {{ trans('me.create_your_account') }}
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
