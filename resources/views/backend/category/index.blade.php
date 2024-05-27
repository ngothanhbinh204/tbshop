@include('backend.dashboard.components.heading', [
    'title' => config('apps.categories.index.title'),
])
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">

                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                        <tr>
                            <th data-toggle="true">Tên danh mục</th>
                            <th data-hide="phone">Slug</th>
                            <th data-hide="phone,tablet">Mô tả</th>
                            <th class="text-right" data-sort-ignore="true">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($categories))
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <a href="{{ route('category.product_in_cate', $id = $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td class="text-right">
                                        <div class="">
                                            <a href="" class="btn btn-circle btn-primary dim">
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

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Thêm danh mục sản phẩm
</button>
</div>
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <i class="fa fa-laptop modal-icon"></i>
                <h4 class="modal-title">Thêm thuộc tính</h4>
                <small class="font-bold">Thêm thuộc tính như màu sắc, kích thước cho sản phẩm</small>
            </div>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thuộc tính</label>
                        <select name="type" id="inputcategory" class="form-control" required>
                            <option value="color">Màu sắc</option>
                            <option value="size">Kích thước</option>
                        </select>
                    </div>
                    <div class="form-group colorClassname">
                        <label>Giá trị màu sắc</label>
                        <input name="value" id="v1" class="form-control" type="color"
                            placeholder="Chọn màu sắc" class="form-control" value="df">

                    </div>
                    <div style="display:none" class="form-group sizeClassname">
                        <label>Giá trị kích thước</label>
                        <input name="" id="v2" class="form-control " type="text"
                            placeholder="Nhập kích thước ( S - M - L - XL - ...)" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
