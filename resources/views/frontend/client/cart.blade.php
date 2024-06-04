@extends('frontend.client.layout')

@section('title', 'Trang Giỏ Hàng')

@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá gốc</th>
                                    <th>Sale( % )</th>
                                    <th>Tổng cộng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cart)
                                    @if (auth()->check())
                                        @foreach ($cart->product as $item)
                                            <tr id="row-{{ $item->id }}">
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img width="100px"
                                                            src="{{ asset('uploads/product/' . $item->product->image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <a href="{{ route('client.product.detail', $item->id_product) }}">
                                                            <h6>{{ $item->product->name }}</h6>
                                                        </a>

                                                        <span>{{ $item->product_size }}</span>
                                                        |
                                                        <span style="color: {{ $item->product_color }}"
                                                            class="fa fa-circle"></span>

                                                        {{-- <h5>{{ $product }}</h5> --}}
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="d-flex">
                                                            <button
                                                                data-action="{{ route('client.cart.update_quantity_product', ['cart_product_id' => $item->id, 'id_cart' => $cart->id]) }}"
                                                                data-id="{{ $item->id }}" data-mdb-button-init
                                                                data-mdb-ripple-init
                                                                class="btn btn-link px-2 btn-update-quantity"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                <i class="fa fa-angle-left icon-quantity"></i>
                                                            </button>

                                                            <input id="productQuantityInput-{{ $item->id }}"
                                                                min="0" name="quantity"
                                                                value="{{ $item->product_quantity }}" type="number"
                                                                class="form-control form-control-sm" />

                                                            <button
                                                                data-action="{{ route('client.cart.update_quantity_product', ['cart_product_id' => $item->id, 'id_cart' => $cart->id]) }}"
                                                                data-id="{{ $item->id }}" data-mdb-button-init
                                                                data-mdb-ripple-init
                                                                class="btn btn-link px-2 btn-update-quantity"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                <i class="fa fa-angle-right icon-quantity"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- stock price --}}
                                                <td class="cart__price">
                                                    <p
                                                        style="{{ $item->product->price_sale ? 'text-decoration: line-through' : '' }};">
                                                        {{ number_format($item->product_price, 0, ',', '.') }} ₫
                                                    </p>
                                                    @if ($item->product->price_sale)
                                                        <p>
                                                            {{ number_format($item->product_price - $item->product->price_sale * 0.01 * $item->product_price, 0, ',', '.') }}₫
                                                        </p>
                                                    @endif

                                                </td>
                                                {{-- sale --}}
                                                <td class="cart__price">
                                                    {{ number_format($item->product->price_sale, 0, ',', '.') }} %</td>
                                                {{-- price now --}}
                                                <td class="cart__price totalSingleProduct">
                                                    {{ number_format($item->product_quantity * ($item->product_price - $item->product->price_sale * 0.01 * $item->product_price), 0, ',', '.') }}
                                                    ₫</td>
                                                <td class="cart__close">
                                                    <i data-action="{{ route('client.cart.remove_product', $item->id) }}"
                                                        class="fa fa-close btn-remove-product"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($cart as $index => $item)
                                            <tr id="row-{{ $index }}">
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img width="100px"
                                                            src="{{ asset('uploads/product/' . $item['product_image']) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <a
                                                            href="{{ route('client.product.detail', $item['id_product']) }}">
                                                            <h6>{{ $item['product_name'] }}</h6>
                                                        </a>

                                                        <span>{{ $item['product_size'] }}</span>
                                                        |
                                                        <span style="color: {{ $item['product_color'] }}"
                                                            class="fa fa-circle"></span>

                                                        {{-- <h5>{{ $product }}</h5> --}}
                                                    </div>
                                                </td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="d-flex">
                                                            <button data-action="giam" data-index="{{ $loop->index }}"
                                                                class="btn btn-link px-2 session-btn-update-quantity">
                                                                <i class="fa fa-angle-left icon-quantity"></i>
                                                            </button>

                                                            <input min="0" name="quantity"
                                                                value="{{ $item['product_quantity'] }}" type="number"
                                                                class="form-control form-control-sm"
                                                                data-index="{{ $loop->index }}" />

                                                            <button data-action="tang" data-index="{{ $loop->index }}"
                                                                class="btn btn-link px-2 session-btn-update-quantity">
                                                                <i class="fa fa-angle-right icon-quantity"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- stock price --}}
                                                <td class="cart__price">
                                                    <p
                                                        style="{{ $item['product_price_sale'] ? 'text-decoration: line-through' : '' }};">
                                                        {{ number_format($item['product_price'], 0, ',', '.') }} ₫
                                                    </p>
                                                    @if ($item['product_price_sale'])
                                                        <p>
                                                            {{ number_format($item['product_price'] - $item['product_price_sale'] * 0.01 * $item['product_price'], 0, ',', '.') }}₫
                                                        </p>
                                                    @endif

                                                </td>
                                                {{-- sale --}}
                                                <td class="cart__price">
                                                    {{ number_format($item['product_price_sale'], 0, ',', '.') }} %</td>
                                                {{-- price now --}}
                                                <td class="cart__price totalSingleProduct">
                                                    {{ number_format($item['product_quantity'] * ($item['product_price'] - $item['product_price_sale'] * 0.01 * $item['product_price']), 0, ',', '.') }}
                                                    ₫</td>

                                                <td class="cart__close">
                                                    <i data-action="{{ route('client.cart.session_remove_product', ['productId' => $item['id_product']]) }}"
                                                        data-product-id="{{ $item['id_product'] }}"
                                                        data-product-index="{{ $index }}"
                                                        class="fa fa-close session-btn-remove-product"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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

                        @if ($countProductInCart1)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <button class=" primary-btn continue__btn update__btn ">
                                    <i class="fa fa-spinner"></i> Cập nhật giỏ hàng
                                </button>
                            </div>
                        @else
                            <p>Chưa có sản phẩm nào trong giỏ hàng !</p>
                        @endif

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã giảm giá</h6>

                        @if (auth()->user())
                            <form action="{{ route('client.cart.apply_coupon', $id_cart = $cart->id) }}" method="POST">
                                @csrf
                                <input name="code_coupon" type="text" placeholder="Coupon code">
                                <button type="submit">Áp dụng</button>
                            </form>
                        @else
                            <form action="" method="POST">
                                @csrf
                                <input name="code_coupon" type="text" placeholder="Coupon code">
                                <button type="submit">Áp dụng</button>
                            </form>
                        @endif


                        @if (session('discount_amount_price') && session('coupon_id') && session('coupon_code'))
                            <div class="cart__total">

                                <h6>Coupon :</h6>
                                <ul>
                                    <li>Code : <span> {{ session('coupon_code') }}</span></li>
                                    <hr>
                                    <li>Giảm : <span>
                                            {{ number_format(session('discount_amount_price'), 0, ',', '.') }}</span></li>
                                </ul>
                            </div>
                        @endif

                    </div>
                    <div class="cart__total">
                        <h6>Tổng giỏ hàng</h6>
                        <ul>
                            <li>Tổng cộng <span id="totalAmount" data-price=""> </span></li>
                            @if (session('discount_amount_price') && session('coupon_id') && session('coupon_code'))
                                <li>Coupon : {{ session('coupon_code') }} <span id="priceCoupon">

                                        - {{ number_format(session('discount_amount_price'), 0, ',', '.') }} ₫</span></li>
                            @else
                                <li>Coupon : <span id="priceCoupon">
                                        0 ₫</span></li>
                            @endif
                            <hr>
                            <li>Thành tiền <span id="totalPrice"> </span></li>
                        </ul>
                        <a href="{{ route('checkout.index') }}" class="primary-btn">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

@section('scripts')
    <script>
        function formatCurrency(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " ₫";
        }

        $(function() {
            const TIME_TO_UPDATE = 10;
            // Lấy token CSRF từ thẻ meta
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const updateButton = $('.update__btn');
            $(document).on('click', '.update__btn', (function() {
                location.reload();
            }));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Xoá giỏ hàng AJAX - Cart user
            $(document).on('click', '.btn-remove-product', (function(e) {
                let _url = $(this).data('action');
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    // nếu user xác nhận xoá sp
                    if (result.isConfirmed) {
                        // gửi yêu cầu AJAX để xoá
                        $.ajax({
                            url: _url,
                            method: 'POST',
                            success: function(res) {
                                let cartProductId = res.product_cart_id;

                                if (res.remove_product) {
                                    $(`#row-${cartProductId}`).remove();
                                }
                                Swal.fire({
                                    title: "Success",
                                    text: "Sản phẩm đã được xóa khỏi giỏ hàng.",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Error",
                                    text: "Đã xảy ra lỗi khi xóa sản phẩm.",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                    }
                })
            }));
            // Xoá giỏ hàng AJAX - Cart session

            $(document).on('click', '.session-btn-remove-product', (function(e) {
                let _url = $(this).data('action');
                let productId = $(this).data('product-id');
                var index = $(this).data('product-index');
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    // nếu user xác nhận xoá sp
                    if (result.isConfirmed) {
                        // gửi yêu cầu AJAX để xoá
                        $.ajax({
                            url: _url,
                            method: 'POST',
                            data: {
                                index: index
                            },
                            success: function(res) {
                                let index = res.index;

                                if (res.remove_product) {
                                    $(`#row-${index}`).remove();
                                }
                                Swal.fire({
                                    title: "Success",
                                    text: "Sản phẩm đã được xóa khỏi giỏ hàng.",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Error",
                                    text: "Đã xảy ra lỗi khi xóa sản phẩm.",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        })
                    }
                })
            }));

            // Cập nhật giỏ hàng AJAX
            $(document).ready(function() {
                const TIME_TO_UPDATE = 10;

                // hàm tính toán tiền
                function calculateTotal() {
                    var totalAmount = 0;
                    $('.totalSingleProduct').each(function() {
                        var priceText = $(this).text().trim(); // Lấy văn bản giá của sp
                        var price = parseFloat(priceText.replace(/[^\d]/g,
                            '')); // chuyển từ text sang số
                        totalAmount += price; // cộng tổng
                    });

                    var ship = parseFloat($('#ship').text().trim().replace(/[^\d.]/g, ''));

                    var priceCoupon = 0;
                    if ($('#priceCoupon').length > 0) {
                        priceCoupon = parseFloat($('#priceCoupon').text().trim().replace(/[^\d]/g, ''));
                    }

                    var totalPrice = totalAmount - priceCoupon;
                    $('#totalAmount').text(formatCurrency(totalAmount));
                    $('#totalPrice').text(formatCurrency(totalPrice));

                    return {
                        totalAmount: totalAmount,
                        priceCoupon: priceCoupon,
                        totalPrice: totalPrice
                    };
                }

                // Chạy tinh toán
                calculateTotal();

                // njaasnj sự kiến click tăng giảm
                $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
                    let url = $(this).data('action');
                    let id = $(this).data('id');
                    let newQuantity = $(`#productQuantityInput-${id}`).val();
                    let data = {
                        product_quantity: newQuantity
                    };

                    // tính toán giá hiện tại
                    let totals = calculateTotal();

                    if (totals.totalAmount < totals.priceCoupon) {
                        Swal.fire({
                            title: 'Thông báo',
                            text: 'Giá trị của sản phẩm thấp hơn giá trị của coupon. Coupon sẽ không được áp dụng. Bạn có muốn tiếp tục?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Tiếp tục',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Đặt lại giá trị coupon là 0 nếu không hợp lệ
                                totals.priceCoupon = 0;
                                $('#priceCoupon').text(
                                    '0 ₫'); // Cập nhật lại hiển thị của coupon
                                updateProductQuantity(url, data, id);
                            }
                        });
                    } else {
                        updateProductQuantity(url, data, id);
                    }
                }, TIME_TO_UPDATE));


                // Update quantity Session cart
                $(document).on('click', '.session-btn-update-quantity', _.debounce(function(e) {
                    // console.log("Có");
                    let url = $(this).data('action');
                    let index = $(this).data('index');
                    var input = $('input[data-index="' + index + '"]');

                    let currentQuantity = parseInt(input.val());

                    if (url === 'giam' && currentQuantity > 0) {
                        input.val(currentQuantity - 1);
                    } else if (url === 'tang') {
                        input.val(currentQuantity + 1);
                    }

                    let newQuantity = input.val();

                    $.ajax({
                        url: '/session-update-quantity-product-in-cart',
                        method: 'POST',
                        data: {
                            index: index,
                            quantity: newQuantity,
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText)
                        }
                    })
                }, TIME_TO_UPDATE));

                // Function to update product quantity via AJAX
                function updateProductQuantity(url, data, id) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        success: function(res) {
                            let cartProduct = res.product_cart_id;
                            if (res.remove_product) {
                                $(`#row-${cartProduct}`).remove();
                                Swal.fire({
                                    title: "Xoá thành công",
                                    icon: "success",
                                    type: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                let newTotalSingleProduct = newQuantity * (res.product_price -
                                    res.product_price_sale * 0.01 * res.product_price);
                                $(`#row-${id} .totalSingleProduct`).text(newTotalSingleProduct +
                                    ' ₫');
                            }
                            calculateTotal();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

        });
    </script>

@endsection
