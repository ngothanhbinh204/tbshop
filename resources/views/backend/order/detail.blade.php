<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class=" table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th data-toggle="true">Tên sản phẩm</th>
                            <th data-hide="color">Kho</th>
                            <th data-hide="color">Màu sắc | Size</th>
                            <th data-hide="price">Giá</th>
                            <th data-hide="price">Số lượng</th>
                            <th data-hide="price">Tổng</th>
                            <th class="text-right" data-sort-ignore="true">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($details))
                            @foreach ($details as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock }}</td>

                                    <td>
                                        <i style="color: {{ $item->product_color }}" class="fa fa-circle"></i>
                                        | {{ $item->product_size }}
                                    </td>
                                    <td>
                                        {{ number_format($item->product_price, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input id="quantity_order-{{ $item->id_product_order }}" min="0"
                                                name="quantity" value="{{ $item->product_quantity }}" type="number"
                                                class="form-control form-control-sm" />
                                            <button
                                                data-action="{{ route('order.update_quantity_product', $id = $item->id_product_order) }}"
                                                data-id="{{ $item->id_product_order }}" class="btn-update-quantity-order">Thay
                                                đổi</button>
                                        </div>

                                    </td>
                                    <td>
                                        {{ number_format($item->total, 0, ',', '.') }}
                                    </td>

                                    <td class="text-right">
                                        <div class="">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>

{{-- {{ $details->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang --> --}}
