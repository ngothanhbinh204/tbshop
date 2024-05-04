<form action="" method="get">
    <div class="row m-sm">
        <div class="col-sm-3 m-b-xs">
            <select class="form-control" name="status" id="">
                <option value="0">Tất cả trạng thái</option>
                <option value="active" {{ request()->status == 'active' ? 'selected' : false }}>Kích hoạt</option>
                <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : false }}>Chưa kích hoạt
                </option>
            </select>
        </div>

        <div class="col-sm-3 m-b-xs">
            <select name="user_role" class="input-sm form-control input-s-sm inline">
                <option value="">Tất cả các nhóm</option>
                @if (isset($roles))
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ request()->user_role == $role->id ? 'selected' : false }}>
                            {{ $role->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>


        <div class="col-sm-3">
            <div class="input-group">
                <input name="keywords" type="search" value="{{ request()->keywords }}"
                    placeholder="Nhập từ khóa tìm kiếm" class="input-sm form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-primary"> Tìm Kiếm</button>
                </span>
            </div>
        </div>

        <div class="col-sm-3 m-b-xs">
            <div class="card-header pb-0">
                <a class="btn btn-danger my-auto mr-4" href="{{ route('user.create') }}">
                    <i class="fa fa-plus">
                    </i>
                    Thêm mới thành viên</a>
            </div>
        </div>

    </div>
</form>
