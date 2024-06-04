<div class="product__item sale">
    <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/product/' . $product->image) }}">
        @if ($product->price_sale > 0)
            <span class="label">Sale {{ number_format($product->price_sale, 0, ',', '.') }} %</span>
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
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
            <i class="fa fa-star-o"></i>
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
