@extends('admin.layouts.admin')

@section('title')
<title>{{ trans('me.posts') }}</title>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('me.posts') }}</h1>
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
                    <a href="{{ route('admin.post.create') }}" class="btn btn-success float-right m-2"><i
                            class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
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
                                    <a href="{{ route('admin.post.show', ['id' => $post->id]) }}"
                                        class="btn btn-info m-2">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('admin.post.edit', ['id' => $post->id]) }}"
                                        class="btn btn-primary m-2">
                                        <i class="fa fa-pen" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{ route('admin.post.destroy', ['id' => $post->id]) }}" method="post"
                                        class="d-inline" onsubmit="return confirm('{{ trans('Delete') }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-2">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
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
