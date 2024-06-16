<h3>Xin chào {{ $account->username }}</h3>
<p>
    Tôi nhận được thông báo đăng ký tài khoản tại tbshop !
</p>

<p>
    <a href="{{ route('account.verify', $account->email) }}">Nhấn vào đây để xác thực</a>
</p>