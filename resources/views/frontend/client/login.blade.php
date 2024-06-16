<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Trang Đăng Ký - Đăng Nhập </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/loginCss.css') }}" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="{{ asset('frontend/img/hero/hero-2.jpg') }}" alt="">
                <div class="text">
                    <span class="text-1">Mỗi người bạn mới <br> là một trải nghiệm mới</span>
                    <span class="text-2">Let's get connected</span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="{{ asset('frontend/img/hero/hero-1.jpg') }}" alt="">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">

                <form action="{{ route('account.check_login') }}" method="post" class="login-form">
                    @csrf
                    <div class="title">Đăng Nhập</div>
                    <form action="#">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input name="emailOrUsername" value="{{ old('emailOrUsername') }}" type="text"
                                    placeholder="Nhập email hoặc username" required>

                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input name="password" type="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            @error('password')
                                <p style="color: red" class="text-danger text-xs pt-1"> {{ $message }} </p>
                            @enderror
                            <div class="text"><a href="{{ route('account.forgot') }}">Quên mật khẩu?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Đăng Nhập">
                            </div>
                            <div class="text sign-up-text">Bạn chưa có tài khoản? <label for="flip">Đăng ký
                                    ngay</label></div>
                            <div class="text sign-up-text "> <label for="flip">
                                    <a href="{{ route('home.index') }}">Về trang chủ</a></label></div>
                        </div>
                    </form>
                </form>

                <form action="{{ route('account.register') }}" method="post" class="signup-form">
                    @csrf
                    <div class="title">Đăng Ký</div>
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input name="username" type="text" placeholder="Nhập tên người dùng" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input name="email" type="text" placeholder="Nhập email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Nhập mật khẩu" required>
                        </div>
                        <input type="hidden" name="user_role" value="0">
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input name="re_password" type="password" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Đăng Ký">
                        </div>
                        <div class="text sign-up-text">Bạn đã có tài khoản? <label for="flip">Đăng nhập
                                ngay</label></div>
                        <div class="text sign-up-text "> <label for="flip">
                                <a href="{{ route('home.index') }}">Về trang chủ</a></label></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
