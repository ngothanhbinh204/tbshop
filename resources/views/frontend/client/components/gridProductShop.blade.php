<div class="col-lg-9">
    <div class="shop__product__option">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__product__option__left">
                    <p>Showing 1–12 of 126 results</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="shop__product__option__right">
                    <p>Sort by Price:</p>
                    <select>
                        <option value="">Low To High</option>
                        <option value="">$0 - $55</option>
                        <option value="">$55 - $100</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        @if (isset($products))
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ $product->image }}">
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}"
                                            alt=""></a></li>
                                <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}"
                                            alt="">
                                        <span>Compare</span></a>
                                </li>
                                <li><a href="{{ route('client.product.detail', ['id' => $product->id]) }}"><img
                                            src="{{ asset('frontend/img/icon/search.png') }}" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{ $product->name }}</h6>
                            <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="add-cart">+ Xem chi tiết</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5> {{ number_format($product->attribute[0]->pivot->price, 0, ',', '.')}} đ</h5>
                            <div class="product__color__select">
                                @if ($product->attribute->isNotEmpty())
                                    <ul>
                                        @php
                                            $unique_colors = $product->attribute
                                                ->pluck('pivot.attribute_value')
                                                ->unique();
                                        @endphp
                                        @foreach ($unique_colors as $color)
                                            <label style="background : {{ $color }}" for="">
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

    <div class="row">
        <div class="col-lg-12">
            <div class="product__pagination">

            </div>
        </div>
    </div>
    {{ $products->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang -->

</div>
