<div class="wrapper wrapper-content  animated fadeInRight article">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            @if (isset($post))
                <div class="ibox">
                    <div class="ibox-content">

                        <div class=" pull-right">
                            <div style="display:flex" class="box-edit">
                                <form action="{{ route('post.uploadPost', ['id' => $post->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if ($post->status == 0)
                                        <button class="btn btn-info m-sm" type="submit"><i
                                                class="fa fa-upload"></i>&nbsp;&nbsp;<span class="bold">Đăng bài
                                                viết</span></button>
                                    @else
                                        <button class="btn btn-danger m-sm" type="submit"><i
                                                class="fa fa-level-down"></i>&nbsp;&nbsp;<span class="bold">Gỡ bài
                                                viết</span></button>
                                    @endif
                                </form>
                                <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-info m-sm"
                                    type="button"><i class="fa fa-paste"></i> Chỉnh
                                    sửa</a>
                            </div>

                        </div>

                        <div class="text-center article-title">
                            <span class="text-muted">
                                <i class="fa fa-clock-o"></i>
                                {{ $post->created_at->format('d M Y') }}
                            </span>
                            <h1>
                                {{ $post->title }}
                            </h1>
                        </div>
                        <p>
                            {!! $post->content !!}
                        </p>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Tags:</h5>
                                <button class="btn btn-primary btn-xs" type="button">
                                    {{ $post->category_post()->first()->name }}
                                </button>
                                <button class="btn btn-white btn-xs" type="button">Publishing</button>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>Stats:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> 56 comments </div>
                                    <i class="fa fa-eye"> </i> 144 views
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">

                                <h2>Comments:</h2>
                                <div class="social-feed-box">
                                    <div class="social-avatar">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="img/a1.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Andrew Williams
                                            </a>
                                            <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="social-body">
                                        <p>
                                            Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                            their
                                            default model text, and a search for 'lorem ipsum' will uncover many web
                                            sites
                                            still
                                            default model text.
                                        </p>
                                    </div>
                                </div>
                                <div class="social-feed-box">
                                    <div class="social-avatar">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="img/a2.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Michael Novek
                                            </a>
                                            <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="social-body">
                                        <p>
                                            Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                            their
                                            default model text, and a search for 'lorem ipsum' will uncover many web
                                            sites
                                            still
                                            default model text, and a search for 'lorem ipsum' will uncover many web
                                            sites
                                            still
                                            in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                            default model text.
                                        </p>
                                    </div>
                                </div>
                                <div class="social-feed-box">
                                    <div class="social-avatar">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="img/a3.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Alice Mediater
                                            </a>
                                            <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="social-body">
                                        <p>
                                            Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                            their
                                            default model text, and a search for 'lorem ipsum' will uncover many web
                                            sites
                                            still
                                            in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                            default model text.
                                        </p>
                                    </div>
                                </div>
                                <div class="social-feed-box">
                                    <div class="social-avatar">
                                        <a href="" class="pull-left">
                                            <img alt="image" src="img/a5.jpg">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                Monica Flex
                                            </a>
                                            <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="social-body">
                                        <p>
                                            Many desktop publishing packages and web page editors now use Lorem Ipsum as
                                            their
                                            default model text, and a search for 'lorem ipsum' will uncover many web
                                            sites
                                            still
                                            in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                            default model text.
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                </div>
            @endif
        </div>
    </div>


</div>
