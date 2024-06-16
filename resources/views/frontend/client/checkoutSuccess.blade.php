@extends('frontend.client.layout')

@section('title', 'Trang Thanh Toán')

<style>
    .check-icon {
        width: 100px;
        height: 100px;
        fill: #28a745;
    }
</style>
@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <form action="{{ route('client.checkout.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            @if ($order)
                                <div class="checkout__order">
                                    <div class="order__title d-flex justify-content-between align-items-center">
                                        <h4 style="font-weight: 700" class="fw-bold">Thanh toán thành công</h4>
                                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M20.285 2.995l-11.285 11.29-4.285-4.29-1.715 1.705 6 6 13-13.005z" />
                                        </svg>
                                    </div>
                                    <ul style="border: none" class="checkout__total__all ">
                                        <li>Mã đơn hàng : <strong>{{ $order->order_code }}</strong></li>
                                        <li>Ngày giờ đặt hàng : <strong>{{ $order->created_at }}</strong></li>
                                        <li>Trạng thái : <strong>{{ $order->status }}</strong> </li>
                                        <input id="totalPriceInput" name="total" type="hidden" value="">
                                    </ul>

                                    <ul class="checkout__total__products">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($productOrder)
                                                    @foreach ($productOrder as $item)
                                                        <tr>
                                                            <td class="position-relative">
                                                                {{ Str::limit($item->product->name, 30) }}

                                                                <div class="label-checkout">
                                                                    @if ($item->product->price_sale)
                                                                        Giảm
                                                                        {{ number_format($item->product->price_sale, 0, ',', '.') }}
                                                                        %
                                                                    @endif
                                                                </div>

                                                            </td>
                                                            <td>{{ number_format($item->product_price, 0, ',', '.') }}</td>
                                                            <td>X {{ $item->product_quantity }}</td>
                                                            <td>{{ number_format($item->product_price * $item->product_quantity, 0, ',', '.') }}
                                                            </td>
                                                    @endforeach

                                                @endif
                                            </tbody>
                                        </table>
                                    </ul>

                                    <ul class="checkout__total__all">
                                        <li style="font-weight: 700">Tổng đơn hàng : {{ $order->total - $order->ship }}</li>
                                        <li style="font-weight: 700">Phí Ship : {{ $order->ship }}
                                        </li>
                                        <li style="font-weight: 700; font-size: 25px ;color: #e53637">Tổng thanh toán :
                                            {{ $order->total }}
                                        </li>
                                        <input id="totalPriceInput" name="total" type="hidden" value="">
                                    </ul>
                                    <a href="{{ route('client.orders.index') }}"
                                        class="site-btn text-uppercase text-center">Xem lịch sử mua hàng</a>

                                </div>

                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Checkout Section End -->

@endsection

@section('scripts')
    {{-- <script>
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

                // $('.addAddress').on('click', function() {
                //     console.log("Côsoo");
                //     if (provinceSelected && districtSelected && wardSelected) {
                //         var fullAddress = provinceSelected + ' - ' + districtSelected + ' - ' +
                //             wardSelected;
                //         if (address) {
                //             fullAddress += ' - ' + address;
                //         }
                //         $('input[name="user_address"]').val(fullAddress);
                //     }
                // });

            })
        })
    </script> --}}
@endsection
