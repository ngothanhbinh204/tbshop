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
                <form action="{{ route('account.check_forgot') }}" method="post" class="login-form">
                    @csrf
                    <div class="title">Quên mật khẩu</div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input name="email" value="{{ old('email') }}" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Địa chỉ email" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Gửi liên kết đặt lại mật khẩu">
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
