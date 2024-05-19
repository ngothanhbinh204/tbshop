@extends('frontend.client.layout')

@section('title', 'Trang Giỏ Hàng')

@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá gốc</th>
                                    <th>Giảm giá ( % )</th>
                                    <th>Tổng cộng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cart)
                                    @foreach ($cart->product as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img width="100px" src="{{ $item->product->image }}" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $item->product->name }}</h6>
                                                    <span>{{ $item->product_size }}</span>
                                                    |
                                                    <span style="color: {{ $item->product_color }}"
                                                        class="fa fa-circle"></span>

                                                    {{-- <h5>{{ $product }}</h5> --}}
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="{{ $item->product_quantity }}">
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- stock price --}}
                                            <td class="cart__price">{{ $item->product_price }} ₫</td>
                                             {{-- sale --}}
                                            <td class="cart__price">{{ $item->product->price_sale }} %</td>
                                             {{-- price now --}}
                                            <td class="cart__price">{{ $item->product_quantity * $item->product_price - ($item->product->price_sale * 0.01 * $item->product_price) }} ₫</td>
                                            <td class="cart__close"><i class="fa fa-close"></i></td>
                                        </tr>
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop.index') }}">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Cập nhật giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Áp dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng giỏ hàng</h6>
                        <ul>
                            <li>Tổng cộng <span> 169.50 ₫</span></li>
                            <li>Thành tiền <span>$ 169.50</span></li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="primary-btn">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
