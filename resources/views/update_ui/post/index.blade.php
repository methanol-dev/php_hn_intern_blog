@extends('update_ui.layouts.user')

@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('me.title') }}</th>
                            <th scope="col">{{ trans('me.status') }}</th>
                            <th scope="col">{{ trans('me.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $index => $post)
                        <tr>
                            <th scope="row">{{ ++$index }}</th>
                            <td>{{ $post->title }}</td>
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
                            <td class="post-action">
                                <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">
                                    {{ trans('me.show') }}
                                </a>
                                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">
                                    {{ trans('me.edit') }}
                                </a>
                                <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post"
                                    onsubmit="return confirm('{{ trans('Delete') }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary btn-sm">
                                        {{ trans('me.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div><!-- end col -->
            {{ $posts->links() }}
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
