@extends('user.layouts.user')

@section('title')
<title>{{ trans('me.home') }}</title>
@endsection

@section('content')
<main id="main">

    <div class="container">
        <div class="row topspace">
            <div class="col-sm-8 col-sm-offset-2">

                @foreach ($posts as $post)
                <article class="post">
                    <header class="entry-header">
                        <h1 class="entry-title"><a href="{{ route('post.show', ['id' => $post->id]) }}" rel="bookmark">{{ $post->title }}</a></h1>
                    </header>
                    <div class="entry-content">
                        <p><img alt="" src="{{ asset('storage/post/' . $post->images) }}"></p>
                        <p>{!! Str::limit($post->content, 200) !!}<a href="{{ route('post.show', ['id' => $post->id]) }}" class="more-link">{{ trans('me.reading') }}&#8230;</a></p>
                    </div>
                </article>
                @endforeach

            </div>
        </div>

        <center class="">
            <ul class="pagination">
                {{ $posts->links() }}
            </ul>
        </center>


    </div> <!-- /container -->

</main>
@endsection
