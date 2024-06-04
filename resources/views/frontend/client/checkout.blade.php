@extends('frontend.client.layout')

@section('title', 'Trang Thanh Toán')

@section('content')
    <!-- Checkout Section Begin -->
    @if (isset($info_customer))
        <section class="checkout spad">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="checkout__form">
                    <form action="{{ route('client.checkout.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                        href="#">Click
                                        here</a> to enter your code</h6>
                                <h6 class="checkout__title">Chi tiết hoá đơn</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Họ và tên<span>*</span></p>
                                            @error('user_name')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                            <input name="user_name" class="" type="text"
                                                value="{{ old('user_name', $info_customer->username ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            @error('user_email')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                            <input class="form-control" name="user_email" type="text"
                                                value="{{ old('user_email', $info_customer->email ?? '') }}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb-3">

                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="checkout__input">
                                            <p>Thành Phố<span>*</span></p>
                                            <select style="max-height: 150px; overflow-y: auto;"
                                                class="province select2 location" name="province_id" id="province_id"
                                                data-target="districts">
                                                <option value="{{ old('province_id') }}">
                                                    [Chọn Thành Phố]
                                                </option>
                                                {{-- Xuất danh sách thành phố --}}
                                                @if (isset($provinces))
                                                    @foreach ($provinces as $province)
                                                        <option value="{{ $province->code }}">{{ $province->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="checkout__input">
                                            <p>Quận / Huyện<span>*</span></p>
                                            <select class="districts select2 location" name="district_id" id="district_id"
                                                data-target="wards">
                                                <option value="{{ old('district_id') }}" disabled selected>
                                                    Chọn Quận / Huyện
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="checkout__input">
                                            <p>Phường / Xã<span>*</span></p>
                                            <select class="select2  wards" name="ward_id" id="ward_id">
                                                <option value="{{ old('ward_id') }}" disabled selected>
                                                    Chọn Phường / Xã
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <a class="addAddress primary-btn text-white">Thêm địa chỉ </a>


                                <div class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    @error('user_address')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                    <input name="user_address" type="text" placeholder="Địa chỉ giao hàng.."
                                        class="checkout__input__add"
                                        value="{{ old('user_address', $info_customer->address ?? '') }}">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Postcode / ZIP<span>*</span></p>

                                            <input type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Số điện thoại<span>*</span></p>
                                            @error('user_phone')
                                                <span class="text-danger"> {{ $message }} </span>
                                            @enderror
                                            <input name="user_phone" type="text"
                                                value="{{ old('user_phone', $info_customer->phone ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                                <h6 class="checkout__title">Thông tin giao hàng</h6>
                                <div class="row mb-3">
                                    @error('ship')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-check h-100 border rounded-3">
                                            <div class="p-3">
                                                <label for="express_ship" class="form-check-label">
                                                    <input value="70000" class="form-check-input" type="radio"
                                                        name="ship" id="express_ship"
                                                        {{ old('ship') == 70000 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="express_ship">
                                                        Giao hàng hoả tốc
                                                    </label>
                                                    <br>
                                                    <small>Nhận hàng sau 3 tiếng</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-check h-100 border rounded-3">
                                            <div class="p-3">
                                                <label for="fast_ship" class="form-check-label">
                                                    <input value="55000" class="form-check-input" type="radio"
                                                        name="ship" id="fast_ship"
                                                        {{ old('ship') == 55000 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="fast_ship">
                                                        Giao hàng nhanh
                                                    </label>
                                                    <br>
                                                    <small>Nhận hàng sau 1-2 ngày</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-check h-100 border rounded-3">
                                            <div class="p-3">
                                                <label for="normal_ship" class="form-check-label">
                                                    <input value="30000" {{ old('ship') == 30000 ? 'checked' : '' }}
                                                        class="form-check-input" type="radio" name="ship"
                                                        id="normal_ship">
                                                    <label class="form-check-label" for="normal_ship">
                                                        Giao hàng tiết kiệm
                                                    </label>
                                                    <br>
                                                    <small>Nhận hàng sau 3-4 ngày</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="shippingMethod"></div>
                                        {{-- Áp dụng thành công : <p class="text-danger">Giao hàng hoả tốc</p> --}}
                                    </div>
                                    <div class="col-12">
                                        <a name="applyShip" class="site-btn text-uppercase applyShip text-white">Áp
                                            dụng</a>
                                    </div>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc">
                                        Tạo tài khoản ngay?
                                        <input type="checkbox" id="acc" name="acc"
                                            {{ old('acc') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>Tạo một tài khoản bằng cách nhập thông tin dưới đây. Nếu bạn là khách hàng cũ vui
                                        lòng
                                        đăng nhập ở đầu trang</p>
                                </div>
                                <div class="checkout__input">
                                    <p>Mật khẩu tài khoản<span>*</span></p>
                                    <input name="user_password" type="password">
                                </div>


                                <div class="checkout__input__checkbox">
                                    <label for="note_order">
                                        Lưu ý về đơn đặt hàng của bạn, ví dụ: Thông báo đặc biệt về giao hàng
                                        <input type="checkbox" id="note_order" name="note_order"
                                            {{ old('note_order') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input">
                                    <p>Lưu ý về đơn hàng : <span>*</span></p>
                                    <input name="note" type="text"
                                        placeholder="Lưu ý về đơn đặt hàng của bạn, ví dụ: Thông báo đặc biệt về giao hàng">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <div class="checkout__order">
                                    <h4 class="order__title">Đơn hàng của bạn</h4>
                                    <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>

                                    <ul class="checkout__total__products">
                                        @if ($cart)
                                            @foreach ($cart->product as $item)
                                                <li>{{ $item->product_quantity }} x
                                                    {{ Str::limit($item->product->name, 20) }}
                                                    <del class="">
                                                        {{ number_format($item->product_price * $item->product_quantity, 0, ',', '.') }}
                                                        </delete>
                                                        <span
                                                            class="totalSingleProduct">{{ number_format($item->product_quantity * ($item->product_price - $item->product->price_sale * 0.01 * $item->product_price), 0, ',', '.') }}
                                                            ₫</td>
                                                        </span>
                                                </li>
                                            @endforeach

                                        @endif
                                    </ul>

                                    <ul class="checkout__total__all">
                                        <li>Tổng đơn hàng <span id="subTotal"></span></li>
                                        <li>Phí Ship <span id="ship"></span>
                                        </li>

                                        @if (session('discount_amount_price') && session('coupon_id') && session('coupon_code'))
                                            <li>Coupon : {{ session('coupon_code') }} <span id="priceCoupon">
                                                    - {{ number_format(session('discount_amount_price'), 0, ',', '.') }}
                                                    ₫</span></li>
                                        @else
                                            <li>Coupon : <span id="priceCoupon">
                                                    0 ₫</span></li>
                                        @endif
                                        <li>Tổng thanh toán <span style="font-size: 25px" id="totalPrice"
                                                class=""></span></li>
                                        <input id="totalPriceInput" name="total" type="hidden" value="">
                                    </ul>


                                    <div class="checkout__input__checkbox">
                                        <h5>Vui lòng chọn phương thức thanh toán</h5>
                                        @error('payment')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                        <label for="payment">
                                            Thanh toán khi nhận hàng
                                            <input value="check_payment"
                                                {{ old('payment') == 'check_payment' ? 'checked' : '' }} type="radio"
                                                name="payment" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Thanh toán qua Paypal
                                            <input value="paypal" {{ old('payment') == 'paypal' ? 'checked' : '' }}
                                                type="radio" name="payment" id="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    {{-- <input type="hidden" name="order_code" id=""> --}}
                                    <button type="submit" class="site-btn text-uppercase">Thanh toán ngay</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endif


    <!-- Checkout Section End -->

@endsection

@section('scripts')
    <script>
        var labelValue = '';
        $(document).ready(function() {
            // Khởi tạo Select2
            $('.select2').select2();
        });

        function formatCurrency(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " ₫";
        }
        // hàm tính toán tiền
        function calculateTotal() {
            var subTotal = 0;
            $('.totalSingleProduct').each(function() {
                var priceText = $(this).text().trim(); // Lấy văn bản giá của sản phẩm
                var price = parseInt(priceText.replace(/[^\d]/g, '')); // Chuyển từ text sang số nguyên
                subTotal += price; // Cộng tổng
            });

            var ship = 0;
            var priceCoupon = 0;
            if ($('#priceCoupon').length > 0) {
                priceCoupon = parseInt($('#priceCoupon').text().trim().replace(/[^\d]/g, ''));
            }
            updateTotal(subTotal, ship, priceCoupon);
            $('.applyShip').on('click', function() {
                ship = parseInt($('input[name="ship"]:checked').val());
                var labelValue = "";
                
                $('.form-check-input[name="ship"]').on('change', function() {
                    labelValue = $(this).next('label').text().trim(); // Lấy giá trị của label tương ứng
                    console.log("Label được chọn:", labelValue);
                });

                updateTotal(subTotal, ship, priceCoupon);
            });

            function updateTotal(subTotal, ship, priceCoupon, labelValue) {
                var totalPrice = (subTotal + ship) - priceCoupon;
                $('#subTotal').text(formatCurrency(subTotal));
                $('#totalPrice').text(formatCurrency(totalPrice));
                $('#ship').text(formatCurrency(ship));
                $('#selectedShippingMethod').text("Phương thức giao hàng : " + labelValue);
                $('#ship').text(formatCurrency(ship));
                $('#totalPriceInput').val(totalPrice);
                console.log(labelValue);
            }
        }
        calculateTotal();


        $(document).ready(function() {
            $('.select2').change(function() {
                var provinceSelected = $('#province_id option:selected').text().trim();
                var districtSelected = $('#district_id option:selected').text().trim();
                var wardSelected = $('#ward_id option:selected').text().trim();
                var address = $('input[name="user_address"]').val();

                $('.addAddress').on('click', function() {
                    console.log("Côsoo");
                    if (provinceSelected && districtSelected && wardSelected) {
                        var fullAddress = provinceSelected + ' - ' + districtSelected + ' - ' +
                            wardSelected;
                        if (address) {
                            fullAddress += ' - ' + address;
                        }
                        $('input[name="user_address"]').val(fullAddress);
                    }
                });

            })
        })
    </script>
@endsection
