@extends('frontend.client.layout')

@section('title', 'Về chúng tôi')

@section('content')
    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="{{ asset('frontend/img/about/about-us.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi là ai?</h4>
                        <p>Các chương trình quảng cáo theo ngữ cảnh đôi khi có những chính sách nghiêm ngặt cần tuân thủ.
                            Hãy lấy Google làm ví dụ.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi làm gì?</h4>
                        <p>Trong thời đại kỹ thuật số này, nơi thông tin có thể dễ dàng được thu thập trong vài giây, danh
                            thiếp vẫn giữ được tầm quan trọng của chúng.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Tại sao chọn chúng tôi</h4>
                        <p>Một ngôi nhà hai hoặc ba tầng là cách lý tưởng để tối đa hóa mảnh đất mà ngôi nhà của chúng ta
                            nằm trên, nhưng đối với người già hoặc người bệnh.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“Đi ra ngoài sau giờ làm việc? Mang theo máy uốn tóc butan của bạn đến văn phòng, làm nóng nó
                            lên, tạo kiểu tóc trước khi rời văn phòng và bạn sẽ không cần phải quay về nhà.”</p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="{{ asset('frontend/img/about/testimonial-author.jpg') }}" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>Augusta Schultz</h5>
                                <p>Thiết kế thời trang</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="img/about/testimonial-pic.jpg"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>Khách hàng <br />của chúng tôi</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">30</h2>
                        </div>
                        <span>Tổng số <br />Danh mục</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>Trong <br />Quốc gia</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">98</h2>
                            <strong>%</strong>
                        </div>
                        <span>Khách hàng <br />hài lòng</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Đội ngũ của chúng tôi</span>
                        <h2>Gặp gỡ Đội ngũ của chúng tôi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('frontend/img/about/team-1.jpg') }}" alt="">
                        <h4>John Smith</h4>
                        <span>Thiết kế thời trang</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('frontend/img/about/team-2.jpg') }}" alt="">
                        <h4>Christine Wise</h4>
                        <span>Giám đốc điều hành</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('frontend/img/about/team-3.jpg') }}" alt="">
                        <h4>Sean Robbins</h4>
                        <span>Quản lý</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{ asset('frontend/img/about/team-4.jpg') }}" alt="">
                        <h4>Lucy Myers</h4>
                        <span>Giao hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Đối tác</span>
                        <h2>Khách hàng hài lòng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-1.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-2.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-3.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-4.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-5.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-6.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-7.png') }}"
                            alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{ asset('frontend/img/clients/client-8.png') }}"
                            alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section End -->
@endsection
