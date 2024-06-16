@php
    $classSp = '';
    if ($product->orderByDesc('id')) {
        $classSp .= 'New ';
    }
    if ($product->is_sale) {
        $classSp .= 'Sale ';
    }
    if ($product->best_order) {
        $classSp .= 'Bestseller ';
    }

@endphp

<div class="product__item sale">
    <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product/' . $product->image) }}">

        @if ($product->is_sale)
            <span class="label">Giảm giá {{ number_format($product->price_sale, 0, ',', '.') }}%</span>
        @endif
        @if ($product->orderByDesc('created_at')->take(1))
            <span class="label">Mới</span>
        @endif
        @if ($product->best_order)
            <span class="label">Bán chạy</span>
        @endif

        <ul class="product__hover">
            <li><a href="#"><img src="{{ asset('frontend/img/icon/heart.png') }}" alt=""></a></li>
            <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png') }}" alt="">
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
            @if ($product->comments->avg('stars') > 0)
                @php
                    $avgStar = $product->comments->avg('stars');
                @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $avgStar)
                        <i class="fa fa-star"></i>
                    @elseif ($i > $avgStar && $i < $avgStar + 1)
                        <i class="fa fa-star-half-o"></i>
                    @else
                        <i class="fa fa-star-o"></i>
                    @endif
                @endfor
            @else
                Chưa có đánh giá
            @endif

            {{-- <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i> --}}
            <span class="ml-3 views">
                {{ $product->views }}
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <h5> {{ number_format($product->attribute[0]->pivot->price, 0, ',', '.') }} đ</h5>
        {{-- {{ $product->attribute[0]->pivot->attribute_value }} --}}
        <div class="product__color__select">
            @if ($product->attribute->isNotEmpty())
                <ul>
                    @foreach ($product->attribute->unique('value') as $color)
                        <label style="background : {{ $color->value }}" for="">
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
