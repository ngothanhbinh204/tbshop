<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lấy lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
        }

        p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Xin chào {{ $user->username }}</h3>
        <p>Email này để giúp bạn lấy lại mật khẩu tài khoản tại TbShop!</p>
        <p>Vui lòng click vào link dưới đây để đặt lại mật khẩu.</p>
        <p><strong>Chú ý:</strong> Mã này chỉ có hiệu lực trong vòng 72 giờ.</p>
        <p><a style="color: #fff;"
                href="{{ route('account.reset_password', ['user' => $user->id, 'token' => $token]) }}">Lấy lại tài
                khoản</a>
        </p>
    </div>
</body>

</html>
