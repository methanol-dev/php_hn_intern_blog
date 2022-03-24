@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.search') }}</title>
@endsection

@section('content')
<main id="main">

    <div class="container">
        <div class="row topspace">
            <div class="col-sm-8 col-sm-offset-2">
                <p class="mt-20 text-center entry-title">{{ trans('me.results_found_for')
                    }} "{{$input}}"</p>
                @if ($results->count() > 0)
                @foreach ($results as $result)
                <article class="post">
                    <header class="entry-header">
                        <h1 class="entry-title"><a href="#" rel="bookmark">{{ $result->title }}</a></h1>
                        <h2 class="entry-title">{{ trans('me.author') . ": " }}{{ $result->full_name }}</h2>
                    </header>
                    <div class="entry-content">
                        <p><img alt="" src="{{ asset('storage/post/' . $result->images) }}"></p>
                        <p>{!! Str::limit($result->content, 200) !!}<a href="#" class="more-link">{{ trans('me.reading')
                                }}&#8230;</a></p>
                    </div>
                </article>
                @endforeach
                <center class="">
                    <ul class="pagination">
                        {{ $results->links() }}
                    </ul>
                </center>
                @else
                <p>{{ trans('me.no_post') }}</p>
                @endif

            </div>
        </div>
    </div>

</main>
@endsection
