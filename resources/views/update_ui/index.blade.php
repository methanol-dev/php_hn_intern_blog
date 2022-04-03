@extends('update_ui.layouts.user')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent Post</h4>
                    </div><!-- end blog-top -->

                    <div class="blog-list clearfix">
                        @foreach ($posts as $post)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{ asset('storage/post/' . $post->images) }}" alt=""
                                            class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->

                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{ route('post.show', ['id' => $post->id]) }}" title="">{{ $post->title }}</a></h4>
                                <p>{!! Str::limit($post->content, 200) !!}</p>
                                <small><a href="tech-single.html" title="">{{ $post->created_at }}</a></small>
                                <small><a href="tech-author.html" title="">by {{ $post->user->full_name }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->

                        <hr class="invis">
                        @endforeach
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                {{ $posts->links() }}
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
@endsection
