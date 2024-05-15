{{-- <div id="preloder">
    <div class="loader"></div>
</div> --}}

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="#">Sign in</a>
            <a href="#">FAQs</a>
        </div>
        <div class="offcanvas__top__hover">
            <span>Usd <i class="arrow_carrot-down"></i></span>
            <ul>
                <li>USD</li>
                <li>EUR</li>
                <li>USD</li>
            </ul>
        </div>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src=" {{ asset('frontend/img/icon/search.png') }}"
                alt=""></a>
        <a href="#"><img src=" {{ asset('frontend/img/icon/heart.png') }}" alt=""></a>
        <a href="#"><img src=" {{ asset('frontend/img/icon/cart.png') }}" alt=""> <span>0</span></a>
        <div class="price">$0.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <a href="#">Sign in</a>
                            <a href="#">FAQs</a>
                        </div>
                        <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li>USD</li>
                                <li>EUR</li>
                                <li>USD</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="header__logo">
                    <a href="{{ asset('home.index') }}"><img src=" {{ asset('frontend/img/logo.png') }}"
                            alt=""></a>
                </div>
            </div>

            <div class="col-lg-8 col-md-8">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                        <li><a href="{{ route('shop.index') }}">Cửa hàng</a></li>
                        <li><a href="{{ route('shop.index') }}">Về chúng tôi</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About Us</a></li>
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('blogs.index') }}">Tin tức</a></li>
                        <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src=" {{ asset('frontend/img/icon/search.png') }}"
                            alt=""></a>
                    <a href="#"><img src=" {{ asset('frontend/img/icon/heart.png') }}" alt=""></a>
                    <a href="#"><img src=" {{ asset('frontend/img/icon/cart.png') }}" alt="">
                        <span>0</span></a>
                    <div class="price">$0.00</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
