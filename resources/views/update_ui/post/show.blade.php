@extends('update_ui.layouts.user')

@section('content')
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb hidden-xs-down">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item active">{{ $post->title }}
                            </li>
                        </ol>

                        <h3>{{ $post->title }}</h3>

                        <div class="blog-meta big-meta">
                            <small>{{ $post->created_at }}</a></small>
                            <small>by {{ $post->user->full_name }}</small>
                        </div><!-- end meta -->

                    </div><!-- end title -->

                    <div class="blog-content">
                        {!! $post->content !!}
                    </div><!-- end content -->

                    <hr class="invis1">

                    <div id="Comments-box" class="custombox clearfix">
                        <h4 class="small-title">{{ trans('me.comment') }}</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">
                                    @foreach ($comments as $comment)
                                    <div class="media" id="comment-{{ $comment->id }}">
                                        <a class="media-left" href="#">
                                            <img src="{{ asset('storage/user/' . optional($comment->user)->avatar) }}"
                                                alt="" class="rounded-circle">
                                        </a>
                                        <div class="media-body">
                                            <div class="parent-comment" id="parent-comment-{{ $comment->id }}">
                                                <h4 class="media-heading user_name">{{ $comment->user->full_name
                                                    }}<small>{{
                                                        $comment->created_at }}</small></h4>
                                                <p>{{ $comment->content }}</p>
                                                <button class="btn btn-primary btn-sm reply"
                                                    data-id="{{ $comment->id }}">{{ trans('me.reply') }}</button>
                                                <button class="btn btn-primary btn-sm edit"
                                                    data-id="{{ $comment->id }}">{{ trans('me.edit') }}</button>
                                                <button class="btn btn-primary btn-sm delete"
                                                    data-id="{{ $comment->id }}">{{ trans('me.delete') }}</button>
                                            </div>

                                            <hr class="invis1">

                                            <div class="col-lg-12 edit-parent-comment"
                                                id="edit-parent-comment-{{ $comment->id }}">
                                                <form action="{{ route('comment.update', ['id' => $comment->id]) }}"
                                                    method="POST" class="form-wrapper">
                                                    @csrf
                                                    @method('PUT')
                                                    <textarea class="form-control"
                                                        name="content">{{ $comment->content }}</textarea>
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ trans('me.submit') }}</button>
                                                </form>
                                            </div>
                                            @foreach ($comment->getChilComment as $reply)
                                            <div class="media children" id="children-{{ $reply->id }}">
                                                <a class="media-left" href="#">
                                                    <img src="{{ asset('storage/user/' . optional($reply->user)->avatar) }}"
                                                        alt="" class="rounded-circle">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading user_name">{{ $reply->user->full_name
                                                        }}
                                                        <small>{{ $reply->created_at }}</small>
                                                    </h4>
                                                    <div class="children-comment"
                                                        id="children-comment-{{ $reply->id }}">
                                                        <p>{{ $reply->content }}</p>
                                                        <button class="btn btn-primary btn-sm edit-reply"
                                                            data-id="{{ $reply->id }}">{{ trans('me.edit') }}</button>
                                                        <button class="btn btn-primary btn-sm delete-reply"
                                                            data-id="{{ $reply->id }}">{{ trans('me.delete') }}</button>
                                                    </div>

                                                    <hr class="invis1">

                                                    <div class="col-lg-12 eidt-children-comment"
                                                        id="eidt-children-comment-{{ $reply->id }}">
                                                        <form
                                                            action="{{ route('comment.update', ['id' => $reply->id]) }}"
                                                            method="POST" class="form-wrapper">
                                                            @csrf
                                                            @method('PUT')
                                                            <textarea class="form-control"
                                                                name="content">{{ $reply->content }}</textarea>
                                                            <button type="submit" class="btn btn-primary">{{
                                                                trans('me.submit') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-lg-12 reply-commentform"
                                                id="reply-commentform-{{ $comment->id }}">
                                                <form
                                                    action="{{ route('reply.store', ['post_id' => $post->id, 'parent_id' => $comment->id]) }}"
                                                    method="POST" class="form-wrapper">
                                                    @csrf
                                                    @method('POST')
                                                    <textarea class="form-control" name="content"></textarea>
                                                    <button type="submit" class="btn btn-primary">{{ trans('me.submit')
                                                        }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div><!-- end col -->
                            <div class="col-lg-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-start">
                                        {{ $comments->links() }}
                                    </ul>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end custom-box -->

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">{{ trans('me.leave_comment') }}</h4>
                        <div class="row">
                            @if (Auth::check())
                            <div class="col-lg-12">
                                <form action="{{ route('comment.store', ['post_id' => $post->id]) }}" method="POST"
                                    class="form-wrapper">
                                    @csrf
                                    @method('POST')
                                    <textarea class="form-control" name="content"></textarea>
                                    <button type="submit" class="btn btn-primary">{{ trans('me.submit') }}</button>
                                </form>
                            </div>
                            @else
                            <div class="col-lg-12">
                                <p>{{ trans('me.login_to_comment') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div><!-- end page-wrapper -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
