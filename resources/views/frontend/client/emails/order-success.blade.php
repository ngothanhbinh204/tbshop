<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            line-height: 1.6;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th,
        .order-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .order-details th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://i.imgur.com/cTkTedt.png" alt="Logo">
            <h2>Cảm ơn bạn đã đặt hàng!</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $orderDone->user_name }}</strong>,</p>
            <p>Chúng tôi đã nhận được đơn hàng của bạn. Dưới đây là chi tiết đơn hàng của bạn:</p>
        </div>
        <div class="order-details">
            <h3>Chi tiết đơn hàng</h3>
            <table>
                <tr>
                    <th>Mã đơn hàng</th>
                    <td>{{ $orderDone->order_code }}</td>
                </tr>
                <tr>
                    <th>Ngày đặt hàng</th>
                    <td>{{ $orderDone->order_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td>{{ $orderDone->status }}</td>
                </tr>
            </table>
            <h3>Sản phẩm</h3>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetailDone as $product)
                        <tr>
                            <td>{{ $product->product->name }}</td>
                            <td>{{ $product->product_quantity }}</td>
                            <td>{{ number_format($product->product_price, 0, ',', '.') }} đ</td>
                            <td>{{ number_format($product->total, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Phí giao hàng</th>
                        <th>{{ number_format($orderDone->ship, 0, ',', '.') }} đ</th>
                    </tr>
                    <tr>
                        <th colspan="3">Tổng cộng</th>
                        <th>{{ number_format($orderDone->total, 0, ',', '.') }} đ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer">
            <p>Đây là email tự động, vui lòng không trả lời email này.</p>
            <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email info@ngothanhbinh.click hoặc
                số điện thoại 0339049735.</p>
            <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi!</p>
        </div>
    </div>
</body>

</html>
