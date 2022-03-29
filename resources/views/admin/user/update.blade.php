@extends('admin.layouts.admin')

@section('title')
<title>{{ trans('me.change_status') }}</title>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('me.change_status') }}</h1>
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
                    <form action="{{ Route('admin.update', ['id' => $user->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="block" value="1" {{ ($user->status) ? 'checked' : ''}}>
                            <label class="form-check-label" for="block">
                                {{ trans('me.block') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="un_block" value="0" {{ $user->status ? '' : 'checked'}}>
                            <label class="form-check-label" for="un_block">
                                {{ trans('me.un_block') }}
                            </label>
                        </div>
                        <input type="submit" value="{{ trans('me.change_status') }}">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

@endsection
