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
                        <i style="color: {{ request()->color == $item->value ? $item->value : '' }}" id="colorDisplay"
                            class="fa fa-circle"></i>
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
                    @include('frontend.client.components.productSingle', [
                        'product' => $product,
                    ])
                </div>
            @endforeach
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="product__pagination">
                {{ $products->appends(['keywords' => $keywords])->links('frontend.client.components.pagination') }}
                <!-- Hiển thị link phân trang -->
            </div>
        </div>
    </div>

    {{-- {{ $products->appends(['keywords' => $keywords])->links('pagination::bootstrap-5') }} --}}
    <!-- Hiển thị link phân trang -->
</div>
