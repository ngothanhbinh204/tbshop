@extends('frontend.client.layout')

@section('title', 'Thông tin người dùng')

@section('content') <!-- Map Begin -->
    {{-- <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div> --}}
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Thông tin người dùng</span>
                            <div class="image-user w-25">
                                @if (isset(auth()->user()->image))
                                    <img class="rounded-circle img-thumbnail"
                                        src="{{ asset('uploads/user/' . auth()->user()->image) }}" alt="">
                                @else
                                    <img class="rounded-circle img-thumbnail"
                                        src="{{ asset('uploads/user/user_default.jpg') }}" alt="">
                                @endif
                            </div>
                            <h2>{{ auth()->user()->username }}</h2>
                            {{-- <p>Địa chỉ : {{ auth()->user()->address }} </p> --}}
                        </div>
                        <ul>
                            <li>
                                <h4>Thông tin cơ bản</h4>
                                <p>Email : {{ auth()->user()->email }}<br /> Ngày sinh :
                                    {{ date('d/m/Y', strtotime(auth()->user()->birthday)) }}</p>
                            </li>
                            <li>
                                <h4>Thông tin liên hệ</h4>
                                <p>Địa chỉ : {{ auth()->user()->address }} <br />Số điện thoại : {{ auth()->user()->phone }}
                                </p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Tên người dùng</label>
                                    <input name="username" value="{{ auth()->user()->username }}" type="text"
                                        placeholder="Tên người dùng">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Email</label>
                                    <input name="email" value="{{ auth()->user()->email }}" type="text"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Ngày sinh</label>
                                    <input name="birthday" value="{{ date('d/m/Y', strtotime(auth()->user()->birthday)) }}"
                                        type="text" placeholder="Ngày sinh">
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Số điện thoại</label>
                                    <input name="phone" value="{{ auth()->user()->phone }}" type="text"
                                        placeholder="Số điện thoại">
                                </div>
                                <div class="form-group col-sm-6 flex-column d-flex"> <label
                                        class="form-control-label px-3">Thành
                                        Phố</label>
                                    <select class="province location" name="province_id" id="province_id"
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
                                    <select class="districts location" name="district_id" id="district_id"
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
                                    <select class=wards" name="ward_id" id="ward_id">
                                        <option value="{{ isset($user->ward_id) ? $user->ward_id : 0 }}">
                                            @if (isset($user->ward_name) && isset($user->ward_id))
                                                {{ $user->ward_name }}
                                            @else
                                                [Chọn Phường / Xã]
                                            @endif
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Địa chỉ</label>
                                    <input name="address" value="{{ auth()->user()->address }}" type="text"
                                        placeholder="Địa chỉ"></input>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="site-btn">Thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection

@section('scripts')
    <script>
        var labelValue = '';
        $(document).ready(function() {
            // Khởi tạo Select2
            $('.select2').select2();
        });


        $(document).ready(function() {
            $('.select2').change(function() {
                var provinceSelected = $('#province_id option:selected').text().trim();
                var districtSelected = $('#district_id option:selected').text().trim();
                var wardSelected = $('#ward_id option:selected').text().trim();
                var address = $('input[name="user_address"]').val();

                // $('.addAddress').on('click', function() {
                //     console.log("Côsoo");
                //     if (provinceSelected && districtSelected && wardSelected) {
                //         var fullAddress = provinceSelected + ' - ' + districtSelected + ' - ' +
                //             wardSelected;
                //         if (address) {
                //             fullAddress += ' - ' + address;
                //         }
                //         $('input[name="user_address"]').val(fullAddress);
                //     }
                // });

            })
        })
    </script>
@endsection
