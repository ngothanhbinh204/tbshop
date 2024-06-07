@extends('frontend.client.layout')

@section('title', 'Trang chủuu')

@section('content')

    @php
        $productFilters = [
            'is_hot' => 'HOT',
            'is_sale' => 'New',
            'best_order' => 'Bestseller',
        ];
    @endphp
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="{{ asset('frontend/img/hero/hero-1.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Thời Trang Mùa Hè</h6>
                                <h2>Bộ Sưu Tập Thu - Đông 2030</h2>
                                <p>Nhãn hiệu chuyên tạo ra các sản phẩm cao cấp. Sản xuất có đạo đức với cam kết không ngừng
                                    nghỉ về chất lượng tuyệt hảo.</p>
                                <a href="#" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="{{ asset('frontend/img/hero/hero-2.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ Sưu Tập Mùa Hè</h6>
                                <h2>Bộ Sưu Tập Thu - Đông 2030</h2>
                                <p>Nhãn hiệu chuyên tạo ra các sản phẩm cao cấp. Sản xuất có đạo đức với cam kết không ngừng
                                    nghỉ về chất lượng tuyệt hảo.</p>
                                <a href="#" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Bộ Sưu Tập Quần Áo 2030</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Phụ Kiện</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Giày Mùa Xuân 2030</h2>
                            <a href="#">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Tất cả</li>
                        <li data-filter=".New">Sản phẩm mới</li>
                        <li data-filter=".HOT">Khuyến mãi hot</li>
                        <li data-filter=".Bestseller">Bán chạy nhất</li>
                    </ul>
                </div>
            </div>

            {{-- {{ dd($productsNew_hotSale[0]->is_hot) }} --}}
            <div class="row product__filter">
                @if (isset($productsNew_hotSale))
                    @foreach ($productsNew_hotSale as $product)
                        @php
                            $classSp = '';
                            foreach ($productFilters as $key => $filter) {
                                if ($product->$key) {
                                    $classSp .= $filter . ' ';
                                    // echo "aa";
                                }
                            }
                        @endphp
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{ trim($classSp) }}">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset('uploads/product/' . $product->image) }}">
                                    <span class="{{ trim($classSp) ? 'is_sale' : 'label' }} ">
                                        {{ trim($classSp) }}
                                    </span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}"
                                                    alt=""><span>So sánh</span></a></li>
                                        <li><a href="{{ route('client.product.detail', ['id' => $product->id]) }}"><img
                                                    src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <a href="{{ route('client.product.detail', $id = $product->id) }}" class="add-cart">+
                                        Xem
                                        chi tiết sản phẩm</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{ number_format($product->attribute[0]->pivot->price, 0, ',', '.') }}</h5>
                                    <div class="product__color__select">
                                        @if ($product->attribute->isNotEmpty())
                                            <ul>
                                                @php
                                                    $unique_colors = $product->attribute
                                                        ->pluck('pivot.attribute_value')
                                                        ->unique();
                                                @endphp
                                                @foreach ($unique_colors as $color)
                                                    <label style="background: {{ $color }}" for="">
                                                        <input type="radio" id="">
                                                    </label>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>Không có màu</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Quần Áo Hot <br /> <span>Bộ Sưu Tập Giày</span> <br /> Phụ Kiện</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Giảm Giá</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Trong Tuần</span>
                        <h2>Túi Đeo Nhiều Ngăn Màu Đen</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Ngày</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Giờ</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Phút</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Giây</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/insta-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Đăng kí theo dõi Instagram của chúng tôi để không bỏ lỡ những cập nhật mới nhất về sản phẩm và ưu
                            đãi đặc biệt.</p>
                        <h3>#MYINSTAGRAM</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Blog Mới Nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($latestBlogs))
                    @foreach ($latestBlogs as $post)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ $post->image }}">
                                    <div class="label">Mới</div>
                                </div>
                                <div class="blog__item__text">
                                    <h6><a
                                            href="{{ route('client.blog.detail', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                    </h6>
                                    <ul>
                                        <li>{{ date('d M, Y', strtotime($post->created_at)) }}</li>
                                    </ul>
                                    <p>{!! Str::limit($post->content, 200) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 2) { // Bắt đầu tìm kiếm khi chuỗi dài hơn 2 ký tự
                    $.ajax({
                        url: '/search',
                        type: 'GET',
                        data: {
                            'query': query
                        },
                        success: function(data) {
                            $('#search-results').empty();
                            if (data.length > 0) {
                                $.each(data, function(index, product) {
                                    let productUrl =
                                        "{{ route('client.product.detail', ':id') }}";
                                    productUrl = productUrl.replace(':id', product.id);
                                    let productItem = `
                                        <div class="product__item sale">
                                            <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product/') }}/${product.image}">
                                                ${product.price_sale > 0 ? `<span class="label">Sale ${product.price_sale}%</span>` : ''}
                                                <ul class="product__hover">
                                                    <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a></li>
                                                    <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}" alt="">
                                                            <span>Compare</span></a>
                                                    </li>
                                                    <li><a href="${productUrl}"><img
                                                                src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6>${product.name}</h6>
                                                <a href="${productUrl}" class="add-cart">+ Xem chi tiết</a>
                                                <div class="rating">
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <h5>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}</h5>
                                            </div>
                                        </div>`;
                                    $('#search-results').append(productItem);
                                });
                            } else {
                                $('#search-results').append(
                                    '<div>Không tìm thấy sản phẩm nào</div>');
                            }
                        },
                        error: function() {
                            $('#search-results').empty().append('<div>Đã xảy ra lỗi</div>');
                        }
                    });
                } else {
                    $('#search-results').empty();
                }
            });

            // Đóng search model
            $('.search-close-switch').on('click', function() {
                $('.search-model').hide();
            });
        });
    </script>
@endsection
