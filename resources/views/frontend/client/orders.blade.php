@extends('frontend.client.layout')

@section('title', 'Trang Shop')

@section('content')
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã hoá đơn</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tổng hoá đơn</th>
                <th>Phí Ship</th>
                <th>Tên người nhận</th>
                <th>Email người nhận</th>
                <th>Địa chỉ người nhận</th>
                <th>Ghi Chú</th>
                <th>Phương thức thanh toán</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($orders))
                @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->order_code }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->ship }}</td>
                        <td>{{ $item->user_name }}</td>
                        <td>{{ $item->user_email }}</td>
                        <td>{{ $item->user_address }}</td>
                        <td>{{ $item->note }}</td>
                        <td>{{ $item->payment }}</td>
                        <td>
                            @if ($item->status == 'Đang xử lí')
                                <form action="{{ route('client.orders.cancel', $item->id) }}" method="POST"
                                    id="form-cancel{{ $item->id }}">
                                    @csrf
                                    <button class="btn btn-cancel btn-danger" data-id="{{ $item->id }}">Cancel
                                        Order</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
    {{ $orders->links() }}
@endsection

@section('scripts')
    <script>
        $(function() {
            $(document).on('click', '.btn-cancel', function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                Swal.fire({
                        title: 'Thông báo',
                        text: ' Bạn có chắc chắn huỷ đơn hàng này không?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Tiếp tục huỷ',
                        cancelButtonText: 'Trở về'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(`#form-cancel${id}`).submit();
                        }
                    })
                    .catch();
            })
        })
    </script>
@endsection
