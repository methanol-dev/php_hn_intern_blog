@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.create') }}</title>
@endsection

@push('header')
<link href="{{ asset('bower_components/template_project1/bootstrap-3.4.1/dist/css/bootstrap.min.css') }}"
    rel="stylesheet">
<link href="{{ asset('bower_components/template_project1/summernote/summernote.min.css') }}" rel="stylesheet">
@endpush

@section('content')

<main id="main">
    <div class="container">
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf
                @method('POST')
                {{-- title --}}
                <div class="row form-group">
                    <div class="col col-md-2"><label for="title" class=" form-control-label">{{ trans('me.title')
                            }}</label>
                    </div>
                    <div class="col-12 col-md-10">
                        <input type="text" id="title" name="title" placeholder="{{ trans('me.title') }}"
                            class="form-control">
                    </div>
                </div>

                {{-- image --}}
                <div class="row form-group">
                    <div class="col col-md-2"><label for="file-input" class=" form-control-label">{{ trans('me.image')
                            }}</label>
                    </div>
                    <div class="col-12 col-md-10"><input type="file" id="file-input" name="images"
                            class="form-control-file">
                    </div>
                </div>
                {{-- body --}}
                <div class="row form-group">
                    <div class="col col-md-2"><label for="body" class=" form-control-label">{{ trans('me.content')
                            }}</label>
                    </div>
                    <div class="col-12 col-md-10"><textarea name="content" id="summernote" rows="9"
                            placeholder="Content..." class="form-control"></textarea></div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-2">
                    </div>
                    <div class="col-12 col-md-10">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa fa-dot-circle-o"></i> {{ trans('me.submit') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>

@endsection

@push('footer')

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/template_project1/bootstrap-3.4.1/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/template_project1/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('bower_components/template_project1/summernote/create.js') }}"></script>

@endpush
