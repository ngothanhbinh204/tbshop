{{-- <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class=" table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>

                            <th data-toggle="true">Tên sản phẩm</th>
                            <th data-hide="phone">Thư viện ảnh</th>
                            <th data-hide="phone">Danh mục</th>
                            <th data-hide="all">Mô tả</th>
                            <th data-hide="phone">Xuất xứ</th>
                            <th data-hide="phone">Trạng thái</th>
                            <th class="text-right" data-sort-ignore="true">Thao tác</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($products))
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('product.productAttributes', ['id' => $product->id]) }}"
                                            class="btn-link">
                                            {{ $product->name }}
                                        </a>
                                    </td>
                                    <td><a href="{{ route('admin.gallery.add', $product_id = $product->id) }}">Thêm thư
                                            viện ảnh</a></td>
                                    <td>{{ $product->categories->name }}</td>
                                    <td>{!! Str::limit($product->description, 200) !!}</td>
                                    <td>{{ $product->origin }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="label label-info">Hoạt động</span>
                                        @else
                                            <span class="label label-warning">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="">
                                            <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                class="btn btn-circle btn-primary dim">
                                                <i class="fa fa-edit ">
                                                </i>
                                            </a>
                                            <button type="submit" data-product-id="{{ $product->id }}"
                                                class="btn btn-circle btn-danger deleteItem">
                                                <i class="fa fa-trash ">
                                                </i>
                                            </button>
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
</div> --}}

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
                                            <th data-toggle="true">Tên sản phẩm</th>
                                            <th>Thư viện ảnh</th>
                                            <th>Danh mục</th>
                                            <th>Xuất xứ</th>
                                            <th>Trạng thái</th>
                                            <th data-hide="all">Mô tả</th>
                                            <th>Thao tác</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($products))
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('product.productAttributes', ['id' => $product->id]) }}"
                                                            class="btn-link">
                                                            {{ $product->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.gallery.add', $product_id = $product->id) }}">Thêm
                                                            thư
                                                            viện ảnh</a>
                                                    </td>
                                                    <td>{{ $product->categories->name }}</td>
                                                    <td>
                                                        @if ($product->status == 1)
                                                            <span class="label label-info">Hoạt động</span>
                                                        @else
                                                            <span class="label label-warning">Không hoạt động</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->province->name }}</td>
                                                    <td>{!! Str::limit($product->description) !!}</td>
                                                    <td class="text-right">
                                                        <div class="">
                                                            <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                                class="btn btn-circle btn-primary dim">
                                                                <i class="fa fa-edit ">
                                                                </i>
                                                            </a>
                                                            <button type="submit" data-product-id="{{ $product->id }}"
                                                                class="btn btn-circle btn-danger deleteItem">
                                                                <i class="fa fa-trash ">
                                                                </i>
                                                            </button>
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

{{ $products->links('pagination::bootstrap-5') }} <!-- Hiển thị link phân trang -->
