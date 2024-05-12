@include('backend.dashboard.components.heading', [
    'title' => config('apps.user.create.title'),
    'table' => config('apps.user.create.table'),
])
<div class="container-fluid">
    {{-- xuất lỗi  --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action=" {{ route('user.store') }} " method="post" class="box">
        @csrf
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-7">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Thông tin cơ bản </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <div class="form-group">
                                        <label>Tên người dùng</label>
                                        <input name="username" value="{{ old('username') }}" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control setupSelect2" name="status" id="status">
                                            <option value="0">Không kích hoạt</option>
                                            <option value="1">Kích hoạt</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 b-r">

                                    <div class="form-group">
                                        <label>Họ và Tên</label>
                                        <input name="fullname" value="{{ old('fullname') }}" type="text"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nhóm Thành Viên</label>
                                        <select class="form-control setupSelect2" name="user_role" id="user_role">
                                            @if (isset($roles))
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" value="{{ old('email') }}" type="email"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input name="password" type="password" class="form-control">
                                    </div>

                                </div>
                                <div class="col-sm-6 b-r">

                                    <div class="form-group">
                                        <label>Ngày Sinh</label>
                                        <input name="birthday" value="{{ old('birthday') }}" type="date"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu</label>
                                        <input name="re_password" type="password" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input name="phone" value="{{ old('phone') }}" type="phone"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <input name="image" value="{{ old('image') }}" type="file"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 b-r">
                                    <div class="form-group">
                                        <label>Ngày Sinh</label>
                                        <input name="birthday" value="{{ old('birthday') }}" type="date"
                                            class="form-control">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5 class="text-uppercasse">Thông tin liên hệ</h5>

                        </div>
                        <div class="ibox-content">
                            <div class="form-horizontal">
                                <br>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">Thành
                                        Phố</label>
                                    <select class="province setupSelect2 location" name="province_id" id="province_id"
                                        data-target="districts">
                                        <option value="{{ old('province_id') }}">

                                            [Chọn Thành Phố]
                                        </option>
                                        {{-- Xuất danh sách thành phố --}}
                                        @if (isset($provinces))
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label">Quận/
                                        Huyện</label>
                                    <select class="districts setupSelect2 location" name="district_id" id="district_id"
                                        data-target="wards">
                                        <option value="{{ old('district_id') }}">
                                            [Chọn Quận/Huyện]
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">
                                        Phường/ Xã</label>
                                    <select class="setupSelect2  wards" name="ward_id" id="ward_id">
                                        <option value="{{ old('ward_id') }}">
                                            [Chọn Phường / Xã]
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">Địa
                                        chỉ</label> <input value="{{ old('address') }}" type="text"
                                        id="address" name="address" placeholder="">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="form-group col-sm-12 d-flex justify-content-end pt-3"> <button type="submit"
                            class="btn btn-primary">Lưu Lại</button> </div>
                </div>
            </div>

        </div>

    </form>

</div>
