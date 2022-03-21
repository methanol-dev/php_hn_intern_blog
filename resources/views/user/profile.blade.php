@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.profile') }}</title>
@endsection
@section('content')
<main id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">{{ trans('me.profile') }}</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block"
                                src="{{ asset('storage/user/'. Auth::User()->avatar) }}" alt="Card image cap">
                            <h5 class="text-sm-center mt-2 mb-1">{{ Auth::User()->username }}</h5>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
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
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class=" form-control-label">{{
                                                    trans('me.email') }}</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <p class="form-control-static">{{ Auth::User()->email }}</p>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="first_name"
                                                    class=" form-control-label">{{ trans('me.first_name') }}</label>
                                            </div>
                                            <div class="col-12 col-md-9"><input type="text" id="first_name"
                                                    name="first_name" placeholder=" Text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="last_name"
                                                    class=" form-control-label">{{ trans('me.last_name') }}</label>
                                            </div>
                                            <div class="col-12 col-md-9"><input type="text" id="last_name"
                                                    name="last_name" placeholder=" Text" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="avatar" class=" form-control-label">{{
                                                    trans('me.avatar') }}</label></div>
                                            <div class="col-12 col-md-9"><input type="file" id="avatar" name="avatar"
                                                    class="form-control-file"></div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                            {{ trans('me.submit') }}
                                        </button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <form action="{{ route('changePassword') }}" method="post"
                                        enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="old_password"
                                                    class=" form-control-label">{{ trans('me.old_password') }}
                                                </label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="old_password"
                                                    name="old_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password"
                                                    class=" form-control-label">{{ trans('me.new_password') }}
                                                </label></div>
                                            <div class="col-12 col-md-9"><input type="password" id="password"
                                                    name="password" class="form-control"></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="password_confirmation"
                                                    class=" form-control-label">{{ trans('me.confirm_password') }}
                                                </label></div>
                                            <div class="col-12 col-md-9"><input type="password"
                                                    id="password_confirmation" name="password_confirmation"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                            {{ trans('me.submit') }}
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

</main>

@endsection
