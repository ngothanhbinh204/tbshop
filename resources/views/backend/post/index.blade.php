@include('backend.dashboard.components.heading', [
    'title' => config('apps.post.index.title'),
    'table' => config('apps.post.index.table'),
])

@include('backend.post.components.filter')



<div class="wrapper wrapper-content  animated fadeInRight blog">

    {{-- -------------------------------------- --}}

    <div class="row">
        @if (isset($posts))
            @for ($i = 0; $i < 3; $i++)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    @foreach ($posts->slice($i * 2, 2) as $post)
                        <div class="ibox">
                            <div class="ibox-content">
                                <a href="{{ route('post.detail', ['id' => $post->id]) }}" class="btn-link">
                                    <h2>
                                        {{ $post->title }}
                                    </h2>
                                </a>
                                <div class="m-b-sm">
                                    <i class="fa fa-user-circle-o"> </i>
                                    Tác giả : <strong>{{ $post->users->username }} (
                                        {{ $post->users->role->name }})</strong>
                                </div>
                                <div class="small m-b-xs">
                                    <span class="text-muted"><i class="fa fa-clock-o"></i>
                                        {{ $post->created_at->format('d M Y') }}</span>
                                </div>
                                <p>
                                    {!! Str::limit($post->content, 300) !!}
                                </p>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 ">
                                        <h5>Chủ đề:</h5>
                                        <button class="btn btn-primary btn-xs" type="button">
                                            {{ $post->category_post()->first()->name }}
                                        </button>
                                        {{-- <button class="btn btn-white btn-xs" type="button">Publishing</button> --}}
                                    </div>
                                    <div class="col-sm-12 col-md-6 ">
                                        <div class="small text-right">
                                            <div class="row">
                                                <h5>Trạng thái :

                                                    @if ($post->status == 1)
                                                        <span class="bold label label-success">
                                                            <i class="fa fa-check m-r-sm "></i>Đăng
                                                        </span>
                                                    @else
                                                        <span class="bold label label-warning">
                                                            <i class="fa fa-times m-r-sm "></i>Chưa
                                                            Đăng</span>
                                                    @endif

                                                </h5>
                                            </div>

                                            <div> <i class="fa fa-comments"> </i> 989 comments </div>
                                            <i class="fa fa-eye"> </i> 144 views
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endfor
        @endif

    </div>

    {{ $posts->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang -->


</div>
