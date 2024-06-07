@include('backend.dashboard.components.heading', [
    'title' => config('apps.order.index.title'),
    'table' => config('apps.order.index.table'),
])

@php
    $statusLabels = [
        'Đang xử lí' => 'warning',
        'Chấp nhận đơn hàng' => 'primary',
        'Đang vận chuyển' => 'info',
        'Giao thành công' => 'success',
        'Huỷ' => 'danger',
    ];
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Danh sách đơn hàng được quản lí bởi quản trị viên và cộng tác viên :</h5>
                            </div>
                            <div class="ibox-content">

                                <table class="footable table table-stripped toggle-arrow-tiny">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Đơn hàng</th>
                                            <th>Tổng hoá đơn <i class="fa fa-money"></i></th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Tình trạng</th>
                                            <th data-hide="all">Tên khách hàng</th>
                                            <th data-hide="all">Email</th>
                                            <th data-hide="all">Địa chỉ</th>
                                            <th data-hide="all">Phí ship</th>
                                            <th data-hide="all">Ngày đặt hàng</th>
                                            <th data-hide="all">Ghi Chú</th>
                                            <th data-hide="all">Phường thức thanh toán</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($orders))
                                            @foreach ($orders as $item)
                                                <tr>
                                                    <td><strong>Mã hoá đơn</strong> :
                                                        <small>{{ $item->order_code }}</small>
                                                    </td>
                                                    <td>{{ number_format($item->total, 0, ',', '.') }} ₫</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>

                                                    <td>

                                                        <div class="order-status">
                                                            @if (isset($item->status) && array_key_exists($item->status, $statusLabels))
                                                                <span
                                                                    class=" status-text label label-{{ $statusLabels[$item->status] }}"
                                                                    data-toggle="popover" data-placement="auto right"
                                                                    data-html="true"
                                                                    data-content='<button class=" btn btn-sm status-text  update-status-btn">Cập nhật</button>'>
                                                                    {{ $item->status }}
                                                                    
                                                                </span>
                                                            @else
                                                                <span class="label status-text">
                                                                    Chưa xác định
                                                                </span>
                                                            @endif

                                                            <select style="display: none" name="status"
                                                                class="form-control select-status" id=""
                                                                data-action="{{ route('orders.update_status', $item->id) }}">
                                                                @foreach (config('apps.order.status') as $status)
                                                                    <option value="{{ $status }}"
                                                                        {{ $status == $item->status ? 'selected' : '' }}>
                                                                        {{ $status }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </td>

                                                    <td><i> {{ $item->user_name }}</i></td>
                                                    <td><i> {{ $item->user_email }}</i></td>
                                                    <td><i> {{ $item->user_address }}</i></td>
                                                    <td>{{ $item->ship }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        @if ($item->note == '')
                                                            <span>Không có ghi chú</span>
                                                        @else
                                                            " {{ $item->note }} "
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->payment }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn-white btn btn-xs"
                                                                href="{{ route('orders.details', $id = $item->id) }}">Xem</a>

                                                            <button class="btn-white btn btn-xs">Chỉnh sửa</button>
                                                            <form class="btn-group"
                                                                action="{{ route('orders.remove', $item->id) }}"
                                                                method="POST" id="form-remove-{{ $item->id }}">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn-white btn btn-xs btn-remove-order"
                                                                    data-id="{{ $item->id }}">Xoá</button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
