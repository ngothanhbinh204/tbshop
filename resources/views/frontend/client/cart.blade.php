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
                                        <tr id="row-{{ $item->id }}">
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img width="100px" src="{{ $item->product->image }}" alt="">
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
                                                            data-action="{{ route('client.cart.update_quantity_product', $item->id) }}"
                                                            data-id="{{ $item->id }}" data-mdb-button-init
                                                            data-mdb-ripple-init
                                                            class="btn btn-link px-2 btn-update-quantity"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            <i class="fa fa-angle-left icon-quantity"></i>
                                                        </button>

                                                        <input id="productQuantityInput-{{ $item->id }}" min="0"
                                                            name="quantity" value="{{ $item->product_quantity }}"
                                                            type="number" class="form-control form-control-sm" />

                                                        <button
                                                            data-action="{{ route('client.cart.update_quantity_product', $item->id) }}"
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
                                                    {{ $item->product_price }} ₫
                                                </p>
                                                @if ($item->product->price_sale)
                                                    <p>
                                                        {{ $item->product_price - $item->product->price_sale * 0.01 * $item->product_price }}
                                                    </p>
                                                @endif

                                            </td>
                                            {{-- sale --}}

                                            <td class="cart__price">{{ $item->product->price_sale }} %</td>
                                            {{-- price now --}}
                                            <td class="cart__price totalSingleProduct">
                                                {{ $item->product_quantity * ($item->product_price - $item->product->price_sale * 0.01 * $item->product_price) }}
                                                ₫</td>

                                            <td class="cart__close">
                                                <i data-action="{{ route('client.cart.remove_product', $item->id) }}"
                                                    class="fa fa-close btn-remove-product"></i>
                                            </td>
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

                        @if ($countProductInCart)
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
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Áp dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng giỏ hàng</h6>
                        <ul>
                            <li>Tổng cộng <span id="totalAmount"> </span></li>
                            @if ($countProductInCart)
                                <li>Phí Ship <span id="ship"> 30000 ₫</span></li>
                            @else
                                <li>Phí Ship <span id="ship"> 0 ₫</span></li>
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
        var totalAmount = 0;

        $('.totalSingleProduct').each(function() {
            var priceText = $(this).text().trim(); // Lấy văn bản giá của sp
            var price = parseFloat(priceText.replace(/[^\d.]/g, '')); // chuyển từ text sang số
            totalAmount += price; // cộng tổng
        });

        var ship = parseFloat($('#ship').text().trim().replace(/[^\d.]/g, ''));
        var totalPrice = totalAmount + ship;
        $('#totalAmount').text(totalAmount + ' ₫')
        $('#totalPrice').text(totalPrice + ' ₫')



        $(function() {
            const TIME_TO_UPDATE = 1000;
            // Lấy token CSRF từ thẻ meta
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const updateButton = $('.update__btn');
            $(document).on('click', '.update__btn', (function() {
                location.reload();
            }));
            // mặc định là disabled

            // Thiết lập token CSRF cho tất cả các yêu cầu AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Xoá giỏ hàng AJAX
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

            // Cập nhật giỏ hàng AJAX
            $(document).on('click', '.btn-update-quantity', _.debounce(function(e) {
                let url = $(this).data('action');
                let id = $(this).data('id');
                let data = {
                    product_quantity: $(`#productQuantityInput-${id}`).val()
                };

                // Vô hiệu hóa nút "Cập nhật giỏ hàng" khi bắt đầu gửi AJAX
                updateButton.prop('disabled', true);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        // Trước khi gửi AJAX, vô hiệu hóa nút "Cập nhật giỏ hàng"
                        updateButton.prop('disabled', true);
                    },
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
                        }
                        updateButton.prop('disabled', false);
                        // Swal.fire({
                        //     title: "Thao tác thành công",
                        //     icon: "success",
                        //     type: "success",
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }, TIME_TO_UPDATE));


        });
    </script>

@endsection
