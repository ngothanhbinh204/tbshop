@extends('frontend.client.layout')

@section('title', 'Trang tin tức')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-blog set-bg" data-setbg="{{ asset('frontend/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Bài viết mới nhất</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @if (isset($posts))
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ $post->image }}"></div>
                                <div class="blog__item__text">
                                    <span><img src="img/icon/calendar.png" alt="">
                                        {{ date('d M, Y', strtotime($post->created_at)) }}</span>
                                    <h5>{{ $post->title }}</h5>
                                    <a href="{{ route('client.blog.detail', $id = $post->id) }}">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
