<form action="" method="get">
    <div class="row p-xl">
        <div class="col-sm-3 m-b-xs">
            <select class="form-control setupSelect2" name="status" id="">
                <option value="">Tất cả trạng thái</option>
                <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : false }}>Chưa đăng</option>
                <option value="active" {{ request()->status == 'active' ? 'selected' : false }}>Đăng</option>
            </select>
        </div>
        <div class="col-sm-3 m-b-xs">
            <select name="category_id" class="input-sm form-control input-s-sm inline setupSelect2">
                <option value="">Tất cả danh mục</option>
                @if (!empty($categories))
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request()->category_id == $category->id ? 'selected' : false }}>
                            {{ $category->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <input name="keywords" type="text" placeholder="Nhập từ khóa tìm kiếm" class="input-sm form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-primary"> Tìm Kiếm</button> </span>
            </div>
        </div>
        <div class="col-sm-3 m-b-xs">
            <div class="card-header pb-0">
                <a class="btn btn-danger my-auto mr-4" href="{{ route('post.create') }}">
                    <i class="fa fa-plus">
                    </i>
                    Thêm mới bài viết</a>
            </div>
        </div>

    </div>
</form>
