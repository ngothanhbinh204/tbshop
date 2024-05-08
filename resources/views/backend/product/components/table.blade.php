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
                                    <td>{{ $product->category->name }}</td>
                                    <td>{!! $product->description !!}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
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
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-circle btn-danger">
                                                    <i class="fa fa-trash ">
                                                    </i>
                                                </button>
                                            </form>
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
