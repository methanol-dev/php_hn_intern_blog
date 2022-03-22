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
                </tr>
                @endforeach
            </tbody>
            {{ $posts->links() }}
        </table>
    </div>
</main>

@endsection
