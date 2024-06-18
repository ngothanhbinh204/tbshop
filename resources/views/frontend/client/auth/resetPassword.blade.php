<!DOCTYPE html>
<!-- Coding by CodingNepal | www.codingnepalweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Trang quên mật khẩu </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/loginCss.css') }}" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

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
                <form action="{{ route('account.post_reset_password') }}" method="post" class="login-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="title">Đặt lại mật khẩu</div>
                    <div class="input-boxes">
                        <input name="token" value="{{ $token }}" type="hidden"class="form-control">
                        <input name="email" value="{{ $email }}" type="hidden"class="form-control">
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu mới" required autocomplete="password" autofocus>
                        </div>
                        @error('password')
                        <p style="color: rgb(177, 7, 7)" class="invalid-feedback text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror

                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input name="password_confirm" type="password"
                                class="form-control @error('password_confirm') is-invalid @enderror"
                                placeholder="Xác nhận mật khẩu" required autocomplete="password_confirm" autofocus>
                        </div>
                        @error('password_confirm')
                            <p style="color: rgb(177, 7, 7)" class="invalid-feedback text-danger" role="alert">
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="button input-box">
                            <input type="submit" value="Đặt lại mật khẩu">
                        </div>
                        <div class="text sign-up-text "> <label for="flip">
                                <a href="{{ route('home.index') }}">Về trang chủ</a></label></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
