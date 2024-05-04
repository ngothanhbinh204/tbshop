<div class="row my-3">
    <div class="col-sm-3 m-b-xs"> <select class="form-control" name="perpage" id="">
            @for ($i = 20; $i < 200; $i += 5)
                <option value="{{ $i }}">{{ $i }} bản ghi
                </option>
            @endfor
        </select>
    </div>
    <div class="col-sm-3 m-b-xs">
        <select class="input-sm form-control input-s-sm inline">
            <option value="0">Chọn Nhóm thành viên</option>
            <option value="1">Option 2</option>
            <option value="2">Option 3</option>
            <option value="3">Option 4</option>
        </select>
    </div>
    <div class="col-sm-3">
        <div class="input-group"><input type="text" placeholder="Nhập từ khóa tìm kiếm"
                class="input-sm form-control">
            <span class="input-group-btn">
                <button type="button" class="btn btn-sm btn-primary"> Tìm Kiếm</button> </span>
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
