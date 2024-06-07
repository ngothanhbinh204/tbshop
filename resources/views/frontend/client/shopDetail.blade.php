@extends('frontend.client.layout')

@section('title', 'Trang Chi Tiết Shop')

@section('content')
    <!-- Shop Details Section Begin -->
    <!-- Input để hiển thị giá -->
    {{-- <input type="text" id="priceInput" name="product_price" readonly> --}}

    @if (session('message'))
        <h2 style="text-align: center; width: 100%; color: red">{{ session('message') }}</h2>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($product))

        <section class="shop-details">
            <div class="product__details__pic">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__breadcrumb">
                                <a href="{{ route('home.index') }}">Trang Chủ</a>
                                <a href="{{ route('shop.index') }}">Cửa hàng</a>
                                <span>Chi tiết sản phẩm</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-1.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-2.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-3.png">
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <style type="text/css">
                                .lSSlideOuter .lSPager.lSGallery img {
                                    display: block;
                                    height: 135px;
                                    max-width: 100%;
                                }
                            </style>
                            <div class="tab-content">
                                <ul id="lightSlider">
                                    @foreach ($gallery as $key => $gal)
                                        <li data-thumb="{{ asset('uploads/gallery/' . $gal->image) }}"
                                            data-src="{{ asset('uploads/gallery/' . $gal->image) }}">
                                            <img src="{{ asset('uploads/gallery/' . $gal->image) }}" alt="">
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('client.cart.add') }}" method="post">
                @csrf
                <input name="id_product" type="hidden" value="{{ $product->id }}">
                <div id="productInfo" class="product__details__content">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <div class="product__details__text">
                                    <h4>{{ $product->name }}</h4>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <span> - 5 Reviews</span>
                                        @if (isset($product->price_sale))
                                            <span
                                                style="
                                                background-color: black;
                                                color: white;
                                                padding: 5px
                                                  ">Giảm
                                                {{ number_format($product->price_sale, 0, ',', '.') }} %</span>
                                        @endif

                                    </div>
                                    <h3>
                                        <input type="hidden" id="hiddenPriceInput" name="product_price">

                                        <input type="hidden" id="priceSale" name="price_sale"
                                            value="{{ $product->price_sale }}">

                                        <div class="priceStock" id="priceDisplaySale"></div>

                                        <div id="priceDisplayStock"></div>
                                        <span></span>
                                    </h3>
                                    <div class="product__details__option">
                                        <div class="product__details__option__size">
                                            <span>Kích thước:</span>
                                            @foreach ($sizeUnique as $item)
                                                <label for="{{ $item }}">{{ $item }}
                                                    <input name="product_size" class="check-size" type="radio"
                                                        id="{{ $item }}" value="{{ $item }}">
                                                </label>
                                            @endforeach
                                        </div>
                                        <input id="idPro" value="{{ $product->id }}" type="hidden">
                                        <div class="product__details__option__color">
                                            <span>Màu Sắc:</span>
                                            <span> <i id="colorDisplay" class="fa fa-circle"></i>
                                            </span>
                                            @foreach ($colorUnique as $item)
                                                <label style="background-color: {{ $item }}"
                                                    for="sp-{{ $item }}">
                                                    <input name="product_color" class="check-color" type="radio"
                                                        id="sp-{{ $item }}" value="{{ $item }}">
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="product__details__cart__option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input id="quantityInput" value="1" name="product_quantity"
                                                    type="number" min="1" max="10">
                                            </div>
                                        </div>
                                        <button type="submit" class="primary-btn" id="addToCartBtn">
                                            Thêm vào giỏ hàng
                                        </button>

                                    </div>
                                    <div class="product__details__btns__option">
                                        <a href="#"><i class="fa fa-heart"></i> Thêm và mục yêu thích</a>
                                        {{-- <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a> --}}
                                    </div>
                                    <div class="product__details__last__option">
                                        <h5><span>Đảm bảo thanh toán an toàn</span></h5>
                                        <img src="{{ asset('frontend/img/shop-details/details-payment.png') }}"
                                            alt="">
                                        <ul>
                                            <li><span></span>
                                                <div class="" name="product_price" id="skuDisplay"></div>
                                            </li>
                                            <li><span></span>
                                                <div class="" id="stockDisplay"></div>
                                            </li>
                                            <li><span>Danh mục:</span> {{ $product->categories->name }}</li>
                                            {{-- <li><span>Tag:</span> Clothes, Skin, Body</li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__details__tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                                role="tab">Mô
                                                tả</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Khách
                                                hàng
                                                đánh giá</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Thông
                                                tin
                                                thêm của sản phẩm</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                            <div class="product__details__tab__content">
                                                <div class="product__details__tab__content__item">
                                                    <h5>Mô tả sản phẩm</h5>
                                                    <p>{!! $product->description !!}</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-6" role="tabpanel">
                                            <div class="product__details__tab__content">
                                                <div class="product__details__tab__content__item">
                                                    <h5>Products Infomation</h5>
                                                    <p>A Pocket PC is a handheld computer, which features many of the same
                                                        capabilities as a modern PC. These handy little devices allow
                                                        individuals to retrieve and store e-mail messages, create a contact
                                                        file, coordinate appointments, surf the internet, exchange text
                                                        messages
                                                        and more. Every product that is labeled as a Pocket PC must be
                                                        accompanied with specific software to operate the unit and must
                                                        feature
                                                        a touchscreen and touchpad.</p>
                                                    <p>As is the case with any new technology product, the cost of a Pocket
                                                        PC
                                                        was substantial during it’s early release. For approximately
                                                        $700.00,
                                                        consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                        These days, customers are finding that prices have become much more
                                                        reasonable now that the newness is wearing off. For approximately
                                                        $350.00, a new Pocket PC can now be purchased.</p>
                                                </div>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Material used</h5>
                                                    <p>Polyester is deemed lower quality due to its none natural quality’s.
                                                        Made
                                                        from synthetic materials, not natural like wool. Polyester suits
                                                        become
                                                        creased easily and are known for not being breathable. Polyester
                                                        suits
                                                        tend to have a shine to them compared to wool and cotton suits, this
                                                        can
                                                        make the suit look cheap. The texture of velvet is luxurious and
                                                        breathable. Velvet is a great choice for dinner party jacket and can
                                                        be
                                                        worn all year round.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-7" role="tabpanel">
                                            <div class="product__details__tab__content">
                                                <p class="note">Nam tempus turpis at metus scelerisque placerat nulla
                                                    deumantos
                                                    solicitud felis. Pellentesque diam dolor, elementum etos lobortis des
                                                    mollis
                                                    ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                                    pharetras loremos.</p>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Products Infomation</h5>
                                                    <p>A Pocket PC is a handheld computer, which features many of the same
                                                        capabilities as a modern PC. These handy little devices allow
                                                        individuals to retrieve and store e-mail messages, create a contact
                                                        file, coordinate appointments, surf the internet, exchange text
                                                        messages
                                                        and more. Every product that is labeled as a Pocket PC must be
                                                        accompanied with specific software to operate the unit and must
                                                        feature
                                                        a touchscreen and touchpad.</p>
                                                    <p>As is the case with any new technology product, the cost of a Pocket
                                                        PC
                                                        was substantial during it’s early release. For approximately
                                                        $700.00,
                                                        consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                        These days, customers are finding that prices have become much more
                                                        reasonable now that the newness is wearing off. For approximately
                                                        $350.00, a new Pocket PC can now be purchased.</p>
                                                </div>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Material used</h5>
                                                    <p>Polyester is deemed lower quality due to its none natural quality’s.
                                                        Made
                                                        from synthetic materials, not natural like wool. Polyester suits
                                                        become
                                                        creased easily and are known for not being breathable. Polyester
                                                        suits
                                                        tend to have a shine to them compared to wool and cotton suits, this
                                                        can
                                                        make the suit look cheap. The texture of velvet is luxurious and
                                                        breathable. Velvet is a great choice for dinner party jacket and can
                                                        be
                                                        worn all year round.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="blog__details__comment">
                            <h4>Khu vực bình luận</h4>
                            <div class="row justify-content-center">
                                <div class="col-lg-12 comments p-4 mb-3">
                                    @if ($comments)
                                        @foreach ($comments as $item)
                                            <div class="blog__details__author mb-3">
                                                <div class="blog__details__author__pic">
                                                    @if (isset($item->user->image))
                                                        <img src="{{ asset('uploads/user/' . $item->user->image) }}"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('uploads/user/user_default.jpg') }}"
                                                            alt="">
                                                    @endif

                                                </div>
                                                <div class="blog__details__author__text">
                                                    <span class="mr-3">{{ $item->user->username }}</span>

                                                    <span>
                                                        <i style="color: #ffd43b" class="fa fa-clock-o"
                                                            aria-hidden="true"></i>
                                                        {{ date('d-m-Y, H:i:s', strtotime($item->created_at)) }}
                                                    </span>
                                                </div>
                                                <p class="m-2"> <strong>Nội dung :</strong> {{ $item->comment }}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('client.comment.store', $id = $product->id) }}">
                                    {{-- @method('POST') --}}
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-3 block-comment">
                                            @if (auth()->user())
                                                <section class='rating-widget'>
                                                    <div class='rating-stars text-center'>
                                                        <p>Gửi đánh giá</p>
                                                        <input type="hidden" class="star_rating_value" name="star">
                                                        <ul id='stars'>
                                                            <li class='star' title='Rất tệ' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Tệ' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Tốt' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Tuyệt' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Cực kỳ tốt!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div style="display: none" class='success-box'>
                                                        <div class='clearfix'></div>
                                                        <img alt='tick image' width='32'
                                                            src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                                                        <div class='text-message'></div>
                                                        <div class='clearfix'></div>
                                                    </div>
                                                </section>
                                                <div class="col-lg-12 text-center">
                                                    <textarea placeholder="Đánh giá về sản phẩm" name="comment"></textarea>
                                                    <button type="submit" class="site-btn write-comment">Gửi bình
                                                        luận</button>
                                                </div>
                                            @else
                                                <span class="text-danger">Vui lòng đăng nhập để đánh giá sản phẩm
                                                    <div class="ml-2">
                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                        <a href="{{ route('login.client.index') }}">Đăng nhập ngay</a>
                                                    </div>
                                                </span>
                                            @endif

                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

        </section>

    @endif
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản phẩm liên quan</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    @if (isset($productLienQuan))
                        @foreach ($productLienQuan as $item)
                            @include('frontend.client.components.productSingle')
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $("#lightSlider").lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 4,
                slideMargin: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>

    <script>
        var colorDisplayNone = document.getElementById('colorDisplay');
        colorDisplayNone.style.display = 'none';
        $(document).ready(function() {
            function updatePrice() {
                var color = $('input[name="product_color"]:checked').val();
                var size = $('input[name="product_size"]:checked').val();
                var idPro = $('#idPro').val();
                var price_sale = $('#priceSale').val();
                // console.log(price_sale);
                var addToCartBtn = $('#addToCartBtn');
                addToCartBtn.prop('disabled', true);
                var selectedColor = color;
                var colorDisplay = $('#colorDisplay');
                if (selectedColor) {
                    colorDisplay.css("color", selectedColor)
                    colorDisplay.css("display", "block")
                } else {
                    colorDisplay.css("display", "none")
                }
                if (color && size) {

                    $.ajax({
                        url: '/ajax/get-infoproduct-by-color-size',
                        type: 'GET',
                        data: {
                            idPro: idPro,
                            color: color,
                            size: size
                        },
                        success: function(response) {
                            $('#priceDisplaySale').html(response.price);
                            $('#priceDisplayStock').html('Giá: ' + (response.price - (price_sale *
                                0.01 *
                                response.price)) + ' VNĐ');
                            $('#skuDisplay').html('SKU: ' + response.sku);
                            $('#stockDisplay').html('Còn lại :' + response.stock);
                            $('#priceInput').val(response.price);
                            $('#hiddenPriceInput').val(response.price);
                            addToCartBtn.prop('disabled', false);
                        },
                        error: function() {
                            $('#priceDisplayStock').html('');
                            $('#priceDisplaySale').html('');
                            $('#skuDisplay').html('');
                            $('#stockDisplay').html('');
                            $('#priceInput').val('');
                            $('#hiddenPriceInput').val('');
                            addToCartBtn.prop('disabled', true);
                            alert(
                                'Sản phẩm không có bộ thuộc tính này, vui lòng chọn thuộc tính khác !'
                            );
                        }
                    });
                }
            }

            $('input[name="product_size"]').change(updatePrice);
            $('input[name="product_color"]').change(updatePrice);
            // $('#colorSelect').change(updatePrice);
            // $('#sizeSelect').change(updatePrice);
            updatePrice();
        });

        $(document).ready(function() {
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10);
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });
            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });

            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var inputValueRating = $('.star_rating_value');
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                inputValueRating.val(ratingValue);
                var value = inputValueRating.val();
                console.log(value);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Cảm ơn bạn đã đánh giá " + ratingValue + " sao.";
                } else {
                    msg = "Chúng tôi sẽ cải thiện chất lượng sản phẩm. Bạn đã đánh giá " + ratingValue +
                        " sao.";
                }
                responseMessage(msg);
            });
        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
    </script>
@endsection
