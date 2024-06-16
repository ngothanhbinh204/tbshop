<!-- Phần Footer Bắt Đầu -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="{{asset('frontend/img/logo-tbshop.png') }}" alt=""></a>
                    </div>
                    <p>Khách hàng là trung tâm của mô hình kinh doanh độc đáo của chúng tôi, bao gồm thiết kế.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Mua sắm</h6>
                    <ul>
                        <li><a href="{{ route('shop.index') }}">Cửa hàng quần áo</a></li>
                        <li><a href="#">Giày thịnh hành</a></li>
                        <li><a href="#">Phụ kiện</a></li>
                        <li><a href="#">Giảm giá</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Mua sắm</h6>
                    <ul>
                        <li><a href="{{ route('contact.index') }}">Liên hệ chúng tôi</a></li>
                        <li><a href="#">Phương thức thanh toán</a></li>
                        <li><a href="#">Giao hàng</a></li>
                        <li><a href="#">Trả hàng & Đổi hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Bản tin</h6>
                    <div class="footer__newslatter">
                        <p>Hãy là người đầu tiên biết về sản phẩm mới, lookbook, khuyến mãi và giảm giá!</p>
                        <form action="#">
                            <input type="text" placeholder="Email của bạn">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Bản quyền ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>2020
                        Tất cả các quyền được bảo lưu | Địa chỉ website <i class="fa fa-heart-o" aria-hidden="true"></i> đến <a href="https://ngothanhbinh.click" target="_blank">NgoThanhBinh.click</a>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Phần Footer Kết Thúc -->