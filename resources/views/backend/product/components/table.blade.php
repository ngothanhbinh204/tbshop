<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>

                            <th data-toggle="true">Tên sản phẩm</th>
                            <th data-hide="phone">Danh mục</th>
                            <th data-hide="all">Mô tả</th>
                            <th data-hide="phone">Giá</th>
                            <th data-hide="phone,tablet">Số lượng</th>
                            <th data-hide="phone">Trạng thái</th>
                            <th class="text-right" data-sort-ignore="true">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($products))
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>
                                        It is a long established fact that a reader will be distracted by the
                                        readable
                                        content of a page when looking at its layout. The point of using Lorem
                                        Ipsum is
                                        that it has a more-or-less normal distribution of letters, as opposed to
                                        using
                                        'Content here, content here', making it look like readable English.
                                    </td>
                                    <td>
                                        $76.00
                                    </td>
                                    <td>
                                        800
                                    </td>
                                    <td>
                                        <span class="label label-warning">Low stock</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">View</button>
                                            <button class="btn-white btn btn-xs">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        @endif


                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
