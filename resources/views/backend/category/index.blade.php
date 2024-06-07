@include('backend.dashboard.components.heading', [
    'title' => config('apps.categories.index.title'),
])


<div class="row">
    
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Thêm danh mục sản phẩm
        </button>
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
                                    <td>{!! $category->description !!}</td>
                                    <td class="text-right">
                                        <div class="">
                                            <a href="" class="btn btn-circle btn-primary dim">
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <form action="{{ route('category.delete', $id = $category->id) }}"
                                                id="form-remove-category-{{ $category->id }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button type="submit" data-id="{{ $category->id }}"
                                                    class="btn btn-circle btn-danger btn-remove-category">
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

<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                {{-- <i class="fa fa-laptop modal-icon"></i> --}}
                <h4 class="modal-title">Thêm Danh Mục Sản Phẩm</h4>
                <small class="font-bold">Thêm danh mục mới cho sản phẩm</small>
            </div>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input name="name" type="text" class="form-control" placeholder="Phụ kiện ...">
                    </div>
                    <div class="form-group">
                        <label>Mô tả danh mục</label>
                        <textarea name="description" id="summernoteProduct"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Danh mục cha:</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="">ROOT</option>
                            @foreach ($categories2 as $category)
                                @include('backend.category.components.category', [
                                    'category' => $category,
                                    'level' => 0,
                                ])
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tạo danh mục</button>
                </div>
            </form>

            
        </div>
    </div>
</div>
