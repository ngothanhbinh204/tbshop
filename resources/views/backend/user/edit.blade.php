@include('backend.dashboard.components.heading', [
    'title' => config('apps.user.edit.title'),
    'table' => config('apps.user.edit.table'),
])
@if (isset($user))
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
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">
                <form method="post" action="{{ route('user.updateAvatar', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="profile-image">
                        <div class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-edit"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Chọn
                                                    Hình Ảnh</span>
                                                <input type="file" name="image" /></span>
                                            <span class="fileinput-filename"></span>
                                        </div>

                                        <button type="submit">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        @if ($user->image)
                            <img class="img-circle circle-border m-b-md" alt="profile"
                                src="{{ asset('storage/avatars/' . $user->image) }}" alt="Avatar">
                        @else
                            <img src="{{ asset('storage/avatars/default.jpg') }}"
                                class="img-circle circle-border m-b-md" alt="profile">
                        @endif

                    </div>

                </form>

                <form role="form" method="POST" action={{ route('user.update', $user->id) }}
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    {{ $user->username }}
                                </h2>
                                <h4>Chức vụ : {{ $user->role->name }}</h4>
                                <small>
                                    Mô tả : {{ $user->role->description }}
                                </small>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-3">
                <table class="table small m-b-xs">
                    <tbody>
                        <tr>
                            <td>
                                <strong>142</strong> Projects
                            </td>
                            <td>
                                <strong>22</strong> Followers
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <strong>61</strong> Comments
                            </td>
                            <td>
                                <strong>54</strong> Articles
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>154</strong> Tags
                            </td>
                            <td>
                                <strong>32</strong> Friends
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <small>Sales in last 24h</small>
                <h2 class="no-margins">206 480</h2>
            </div>
        </div>

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
                                    <input name="username" value="{{ $user->username }}" type="text"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" value="{{ $user->email }}" type="email"
                                        class="form-control">
                                </div>

                            </div>
                            <div class="col-sm-6 b-r">

                                <div class="form-group">
                                    <label>Ngày Sinh</label>
                                    <input name="birthday" value="{{ $user->birthday }}" type="date"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input name="phone" value="{{ $user->phone }}" type="phone"
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
                            <h5><strong class="text-danger">Thông tin địa chỉ</strong> : {{ $user->province_name }}
                                /
                                {{ $user->district_name }} /
                                {{ $user->ward_name }} </h5>
                            <br>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-control-label px-3">Thành
                                    Phố</label>
                                <select class="province setupSelect2 location" name="province_id" id="province_id"
                                    data-target="districts">
                                    <option value="{{ isset($user->province_id) ? $user->province_id : 0 }}">
                                        @if (isset($user->province_name) && isset($user->province_id))
                                            {{ $user->province_name }}
                                        @else
                                            [Chọn Thành Phố]
                                        @endif
                                    </option>
                                    {{-- Xuất danh sách thành phố --}}
                                    @if (isset($provinces))
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->code }}">{{ $province->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label">Quận/
                                    Huyện</label>
                                <select class="districts setupSelect2 location" name="district_id" id="district_id"
                                    data-target="wards">
                                    <option value="{{ isset($user->district_id) ? $user->district_id : 0 }}">
                                        @if (isset($user->district_name) && isset($user->district_id))
                                            {{ $user->district_name }}
                                        @else
                                            [Chọn Quận/Huyện]
                                        @endif
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">
                                    Phường/ Xã</label>
                                <select class="setupSelect2  wards" name="ward_id" id="ward_id">
                                    <option value="{{ isset($user->ward_id) ? $user->ward_id : 0 }}">
                                        @if (isset($user->ward_name) && isset($user->ward_id))
                                            {{ $user->ward_name }}
                                        @else
                                            [Chọn Phường / Xã]
                                        @endif
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-control-label px-3">Địa
                                    chỉ</label> <input value="{{ old('address', $user->address) }}" type="text"
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
            <div>
                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Cập
                        Nhật</strong></button>
            </div>
        </div>

    </div>
    </form>
@endif
