<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class=" table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>

                            <th data-toggle="true">Tên sản phẩm</th>
                            <th data-hide="color">Màu sắc | Size</th>
                            <th data-hide="price">Giá</th>
                            <th data-hide="stock">Số lượng tồn kho</th>
                            <th data-hide="stock">Mã lô sản phẩm</th>
                            <th class="text-right" data-sort-ignore="true">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($product))
                            @foreach ($product as $pro)
                                <tr>
                                    <td>{{ $pro->product_name }}</td>
                                    <td>
                                        <i style="color: {{ $pro->color_value }}" class="fa fa-circle"></i>
                                        | {{ $pro->size_value }}
                                    </td>
                                    <td>
                                        {{ $pro->price }} / Chiếc
                                    </td>
                                    <td>
                                        {{ $pro->stock }}
                                    </td>
                                    <td>
                                        {{ $pro->sku }}
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

{{-- {{ $products->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang --> --}}
