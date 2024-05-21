<div class="col-lg-3">
    <div class="shop__sidebar">
        <div class="shop__sidebar__search">
            <form action="" method="GET">
                <input name="keywords" type="search" value="{{ request()->keywords }}" placeholder="Tìm kiếm...">
                <button type="submit"><span class="icon_search"></span></button>
            </form>
        </div>
        <div class="shop__sidebar__accordion">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__categories">

                                <ul class="nice-scroll">

                                    @if (isset($categories))
                                        <li>
                                            <a href="{{ route('shop.index') }}">
                                                Tất cả danh mục ({{ $categories->sum('products_count') }})
                                            </a>
                                        </li>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a
                                                    href="{{ route('client.category.index', [
                                                        'slug' => $category->slug,
                                                        'category_id' => $category->id,
                                                    ]) }}">
                                                    {{ $category->name }} (
                                                    {{ $category->products_count }} )
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseTwo">Thương hiệu</a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__brand">
                                <ul>


                                    @if (isset($brands))
                                        <li>
                                            <a href="{{ route('shop.index') }}">
                                                Tất cả thương hiệu ({{ $brands->sum('products_count') }})
                                            </a>
                                        </li>
                                        @foreach ($brands as $brand)
                                            <li>
                                                <a href="{{ route('client.brand.index', $brand_id = $brand->id) }}">
                                                    {{ $brand->name }} ( {{ $brand->products_count }})
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseThree">Lọc theo giá</a>
                    </div>
                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__price">

                                <ul>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 50000, 'price_max' => 150000]) }}">50.000
                                            ₫ - 150.000 ₫</a></li>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 150000, 'price_max' => 300000]) }}">150.000
                                            ₫ - 300.000 ₫</a></li>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 300000, 'price_max' => 500000]) }}">300.000
                                            ₫ - 500.000 ₫</a></li>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 500000, 'price_max' => 700000]) }}">500.000
                                            ₫ - 700.000 ₫</a></li>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 700000, 'price_max' => 900000]) }}">700.000
                                            ₫ - $900.000 ₫</a></li>
                                    <li><a
                                            href="{{ route('client.filter.price', ['price_min' => 900000, 'price_max' => 1000000]) }}">900.000+</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                    </div>
                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__size">
                                @if (isset($sizes))
                                    @foreach ($sizes as $size)
                                        <label for="{{ $size->value }}">{{ $size->value }}
                                            <input type="radio" id="{{ $size->value }}">
                                        </label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                    </div>
                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__color">
                                @if (isset($colors))
                                    @foreach ($colors as $color)
                                        <label style="background-color: {{ $color->value }}" class=""
                                            for="{{ $color->value }}">
                                            <input type="radio" id="{{ $color->value }}">
                                        </label>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-heading">
                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                    </div>
                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="shop__sidebar__tags">
                                <a href="#">Product</a>
                                <a href="#">Bags</a>
                                <a href="#">Shoes</a>
                                <a href="#">Fashio</a>
                                <a href="#">Clothing</a>
                                <a href="#">Hats</a>
                                <a href="#">Accessories</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
