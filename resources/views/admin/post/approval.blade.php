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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('me.title') }}</th>
                                <th scope="col">{{ trans('me.author') }}</th>
                                <th scope="col">{{ trans('me.status') }}</th>
                                <th scope="col">{{ trans('me.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index => $post)
                            <tr>
                                <th>{{ ++$index }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->full_name }}</td>
                                <td>
                                    @switch ($post->status)
                                        @case (config('constants.pending'))
                                        {{ trans('me.pending') }}
                                        @break
                                        @case (config('constants.approved'))
                                        {{ trans('me.approved') }}
                                        @break
                                        @case (config('constants.reject'))
                                        {{ trans('me.reject') }}
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <form action="{{ route('admin.post.update.approval', ['id' => $post->id]) }}" method="post"
                                        class="d-inline" onsubmit="return confirm('{{ trans('Approved') }}?')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{ config('constants.approved') }}" name="status">
                                        <button class="btn btn-success m-2" id="approved-{{ $post->id }}">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.post.update.approval', ['id' => $post->id]) }}" method="post"
                                        class="d-inline" onsubmit="return confirm('{{ trans('Rejected') }}?')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{ config('constants.reject') }}" name="status">
                                        <button class="btn btn-danger m-2" id="rejected-{{ $post->id }}">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
