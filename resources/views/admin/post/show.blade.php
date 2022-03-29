@extends('admin.layouts.admin')

@section('title')
<title>{{ trans('me.show_post') }}</title>
@endsection

@section('content')

<div class="content-wrapper">
    <div class="container">
        <div class="col-sm-8 col-sm-offset-2">

            <article class="post">
                <header class="entry-header">
                    <div class="entry-meta">
                        <span class="posted-on"><time class="entry-date published" date="2013-06-17">{{
                                $post->created_at }}</time></span>
                    </div>
                    <h1 class="entry-title">{{ $post->title }}</a></h1>
                </header>
                <div class="entry-content">
                    <p><img alt="" src="{{ asset('storage/post/' . $post->images) }}"></p>
                    <p>
                        {!! $post->content !!}
                    </p>
                </div>
            </article>

        </div>
    </div>
</div>

@endsection
