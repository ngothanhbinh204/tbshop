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
        <div class="row d-flex justify-content-between mb-4">
            <div class="col-sm-12 col-md-4 col-lg-4 my-auto p-4">
                <div class="card p-4">
                    <h5 class="fw-bold">Thông Tin Chi Tiết</h5>
                    <span class="text-span">Lưu ý: Những trường đánh dấu <span class="text-danger">( * )</span> là bắt
                        buộc</span>

                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-7">
                <div class="card p-4">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Tên
                                Người Dùng<span class="text-danger">
                                    (*)</span></label>
                            <input value="{{ old('username') }}" type="text" id="username" name="username"
                                placeholder="">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Ngày
                                Sinh</label> <input value="{{ old('birthday') }}" type="date" id="birthday"
                                name="birthday" placeholder=""> </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-control-label px-3">
                                Email<span class="text-danger">(*)</span>
                            </label>
                            <input value="{{ old('email') }}" type="email" id="email" name="email">
                        </div>

                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nhóm
                                thành viên<span class="text-danger">
                                    (*)</span></label>
                            <select value="{{ old('user_role') }}" class="setupSelect2" name="user_role" id="user_role">
                                <option value="0">[Chọn Nhóm Thành Viên]</option>
                                {{-- Xuất danh sách thành phố --}}
                                @if (isset($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Mật Khẩu<span class="text-danger">
                                    (*)</span></label> <input type="password" id="password" name="password"> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Nhập
                                lại mật khẩu<span class="text-danger">
                                    (*)</span></label>
                            <input type="password" id="re_password" name="re_password" placeholder="">
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">
                                Ảnh Đại Diện<span class="text-danger">*</span>
                            </label>
                            <input class="input-image" value="{{ old('image') }}" type="text" id="image"
                                name="image" placeholder="" data-upload="Images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-sm-12 col-md-4 col-lg-4 my-auto p-4">
                <div class="card p-4">
                    <h5 class="fw-bold">Thông Tin Liên Hệ</h5>
                    <div class="text-span">
                        <span>Nhập thông tin chi tiết như địa chỉ, quận, huyện, ...</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-7 col-10">

                <div class="card p-4">
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label
                                class="form-control-label px-3">Thành
                                Phố</label>
                            <select class="province setupSelect2 location" name="province_id" id="province_id"
                                data-target="districts">
                                <option value="0">[Chọn Thành Phố]</option>
                                {{-- Xuất danh sách thành phố --}}
                                @if (isset($provinces))
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->code }}">{{ $province->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label
                                class="form-control-label px-3">Quận/
                                Huyện</label>
                            <select class="districts setupSelect2 location" name="district_id" id="district_id"
                                data-target="wards">
                                <option value="0">[Chọn Quận/Huyện]</option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Phường/ Xã</label>
                            <select class="setupSelect2  wards" name="ward_id" id="ward_id">
                                <option value="0">[Chọn Phường / Xã]</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label
                                class="form-control-label px-3">Địa
                                chỉ</label> <input value="{{ old('address') }}" type="text" id="address"
                                name="address" placeholder="">
                        </div>
                    </div>

                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                Số Điện Thoại</label>
                            <input value="{{ old('phone') }}" type="number" name="phone" id="phone">
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label
                                class="form-control-label px-3">Ghi
                                Chú</label> <input value="{{ old('description') }}" type="text" id="description"
                                name="description" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <div class="form-group col-sm-12 d-flex justify-content-end pt-3"> <button type="submit"
                    class="btn btn-primary">Lưu Lại</button> </div>
        </div>
    </form>

</div>
