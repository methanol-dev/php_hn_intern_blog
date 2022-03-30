@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.post') }}</title>
@endsection

@section('content')

<main id="main">
    <div class="container">
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
                @php
                $i = 0;
                @endphp
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
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
                    <td>
                        <button>
                            <a href="{{ route('post.show', ['id' => $post->id]) }}">
                                {{ 'show' }}
                            </a>
                        </button>
                        <button>
                            <a href="{{ route('post.edit', ['id' => $post->id]) }}">
                                {{ 'edit' }}
                            </a>
                        </button>
                        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="post" class="d-inline"
                            onsubmit="return confirm('{{ trans('Delete') }}?')">
                            @csrf
                            @method('DELETE')
                            <button>
                                {{ 'delete' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</main>

@endsection
