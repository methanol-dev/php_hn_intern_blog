@extends('admin.layouts.admin')

@section('title')
<title>{{ trans('me.post_approval') }}</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('me.post_approval') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.post.update.approval', ['id' => $post->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="approved" value="{{ config('constants.approved') }}">
                            <label class="form-check-label" for="approved">
                                {{ trans('me.approved') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="reject" value="{{ config('constants.reject') }}">
                            <label class="form-check-label" for="reject">
                                {{ trans('me.reject') }}
                            </label>
                        </div>
                        <input type="submit" value="{{ trans('me.submit') }}">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
