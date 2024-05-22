<div class="col-lg-9">

    <form action="" method="GET">
        <div class="shop__product__option">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right">
                        <select class="nice-select" name="category_id" id="">
                            <option value="">All danh mục</option>
                            @foreach ($categories as $item)
                                <option {{ request()->category_id == $item->id ? 'selected' : false }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right">
                        <select class="nice-select" name="brand_id" id="">
                            <option value="">All thương hiệu</option>
                            @foreach ($brands as $item)
                                <option {{ request()->brand_id == $item->id ? 'selected' : false }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right">
                        <select class="nice-select" name="size" id="">
                            <option value="">All size</option>
                            @foreach ($sizes as $item)
                                <option {{ request()->size == $item->value ? 'selected' : false }}
                                    value="{{ $item->value }}">{{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right d-flex align-items-center ">
                        <i style="color: {{ request()->color == $item->value ? $item->value : '' }}" id="colorDisplay" class="fa fa-circle"></i>
                        <select class="nice-select" name="color" id="colorSelect" onchange="updateColor()">
                            <option value="">All màu sắc </option>
                            @foreach ($colors as $item)
                                <option style="background-color: {{ $item->value }}" class="color-option"
                                    {{ request()->color == $item->value ? 'selected' : false }}
                                    value="{{ $item->value }}">{{ $item->value }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right">
                        <input value="" type="hidden" name="price_min" id="price_min">
                        <input value="" type="hidden" name="price_max" id="price_max">
                        <select class="nice-select" id="priceSelect" onchange="updatePriceRange()">
                            <option value="">All mức giá </option>
                            <option value="50000-150000">50.000₫ - 150.000₫</option>
                            <option value="150000-300000">150.000₫ - 300.000₫</option>
                            <option value="300000-500000">300.000₫ - 500.000₫</option>
                            <option value="500000-1000000">500.000₫ - 1.000.000₫</option>
                            <option value="1000000-2000000">1.000.000₫ - 2.000.000₫</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="shop__product__option__right ">
                        <button class="btn btn-outline" type="submit">
                            <i class="fa fa-filter"></i>
                            Lọc</button>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </form>

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
                            <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="add-cart">+
                                Xem chi tiết</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5> {{ number_format($product->attribute[0]->pivot->price, 0, ',', '.') }} đ</h5>
                            <div class="product__color__select">
                                @if ($product->attribute->isNotEmpty())
                                    <ul>
                                        @php
                                            $unique_colors = $product->attribute
                                                ->pluck('pivot.attribute_value')
                                                ->where('pivot.attribute_value.type', '=', 'color')
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
