<div class="container">
    <div id="reviews" class="review-section">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="m-0">{{ $comments->count() }} đánh giá</h4>
            {{-- <select class="custom-select custom-select-sm border-0 shadow-sm ml-2 select2-hidden-accessible"
                data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option data-select2-id="3">Most Relevant</option>
                <option>Most Recent</option>
            </select>
            <select name="" id="">
                <option>Most Recent</option>
                <option>Most Recent</option>
            </select>
            <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2"
                style="width: 188px;">
                <span class="selection">
                    <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                        aria-expanded="false" tabindex="0" aria-labelledby="select2-qd66-container">
                        <span class="select2-selection__rendered" id="select2-qd66-container" role="textbox"
                            aria-readonly="true" title="Most Relevant">Most Relevant</span>
                        <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                    </span>
                </span>
                <span class="dropdown-wrapper" aria-hidden="true"></span>
            </span> --}}
        </div>
        <div class="row">
            @if ($comments->count() > 0)
                <div class="col-md-6">
                    <table class="stars-counters">
                        <tbody>
                            @for ($i = 5; $i > 0; $i--)
                                <tr class="">
                                    <td>
                                        <span>
                                            <button
                                                class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">{{ $i }}
                                                Sao</button>
                                        </span>
                                    </td>
                                    <td class="progress-bar-container">
                                        <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                            <div class="fit-progressbar-background">
                                                <span class="progress-fill"
                                                    style="width: {{ ($comments->where('stars', '=', $i)->count() / $comments->count()) * 100 }}%;">
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="star-num">
                                        ({{ $comments->where('stars', '=', $i)->count() }})
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="ranking">
                        <h6 class="text-display-7">Đánh giá nổi bật</h6>
                        <ul>

                            <li>
                                Seller communication level<span>5<span
                                        class="review-star rate-10 show-one"></span></span>
                            </li>

                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="review-list">
        <ul>
            <li>
                @if ($comments)
                    @foreach ($comments as $item)
                        <div class="d-flex mb-3 bottom-comment">
                            <div class="left">
                                <span>
                                    @if (isset($item->user->image))
                                        <img class="profile-pict-img img-fluid"
                                            src="{{ asset('uploads/user/' . $item->user->image) }}" alt="">
                                    @else
                                        <img class="profile-pict-img img-fluid"
                                            src="{{ asset('uploads/user/user_default.jpg') }}" alt="">
                                    @endif

                                </span>
                            </div>
                            <div class="right">
                                <h4>
                                    {{ $item->user->username }}
                                    <span class="gig-rating text-body-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15"
                                            height="15">
                                            <path fill="currentColor"
                                                d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                            </path>
                                        </svg>
                                        {{ $item->stars }}.0
                                    </span>
                                </h4>
                                <div class="country d-flex align-items-center">
                                    <span class="mr-2">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </span>
                                    <div class="country-name font-accent">
                                        @if ($item->user->province)
                                            {{ $item->user->province->name }}
                                        @else
                                            <span>Chưa có địa chỉ </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="review-description">
                                    <p>
                                        {{ $item->comment }}
                                    </p>
                                </div>
                                <span class="publish py-3 d-inline-block w-100">Đăng lúc
                                    {{ $item->created_at->format('d-m-Y') }}
                                    ({{ $item->created_at->diffForHumans() }})
                                </span>

                                <div class="helpful-thumbs">
                                    <div class="helpful-thumb text-body-2">
                                        <span class="fit-icon thumbs-icon mr-2">
                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.5804 7.81165C13.8519 7.45962 14 7 14 6.43858C14 5.40843 13.123 4.45422 12.0114 4.45422H10.0932C10.3316 3.97931 10.6591 3.39024 10.6591 2.54516C10.6591 0.948063 10.022 0 8.39207 0C7.57189 0 7.26753 1.03682 7.11159 1.83827C7.01843 2.31708 6.93041 2.76938 6.65973 3.04005C6.01524 3.68457 5.03125 5.25 4.44013 5.56787C4.38028 5.59308 4.3038 5.61293 4.22051 5.62866C4.06265 5.39995 3.79889 5.25 3.5 5.25H0.875C0.391754 5.25 0 5.64175 0 6.125V13.125C0 13.6082 0.391754 14 0.875 14H3.5C3.98325 14 4.375 13.6082 4.375 13.125V12.886C5.26354 12.886 7.12816 14.0002 9.22728 13.9996C9.37781 13.9997 10.2568 14.0004 10.3487 13.9996C11.9697 14 12.8713 13.0183 12.8188 11.5443C13.2325 11.0596 13.4351 10.3593 13.3172 9.70944C13.6578 9.17552 13.7308 8.42237 13.5804 7.81165ZM0.875 13.125V6.125H3.5V13.125H0.875ZM12.4692 7.5565C12.9062 7.875 12.9062 9.1875 12.3159 9.48875C12.6856 10.1111 12.3529 10.9439 11.9053 11.1839C12.1321 12.6206 11.3869 13.1146 10.3409 13.1246C10.2504 13.1255 9.32247 13.1246 9.22731 13.1246C7.23316 13.1246 5.54296 12.011 4.37503 12.011V6.44287C5.40611 6.44287 6.35212 4.58516 7.27847 3.65879C8.11368 2.82357 7.83527 1.43153 8.3921 0.874727C9.78414 0.874727 9.78414 1.84589 9.78414 2.54518C9.78414 3.69879 8.94893 4.21561 8.94893 5.32924H12.0114C12.6329 5.32924 13.1223 5.88607 13.125 6.44287C13.1277 6.99967 12.9062 7.4375 12.4692 7.5565ZM2.84375 11.8125C2.84375 12.1749 2.54994 12.4688 2.1875 12.4688C1.82506 12.4688 1.53125 12.1749 1.53125 11.8125C1.53125 11.4501 1.82506 11.1562 2.1875 11.1562C2.54994 11.1562 2.84375 11.4501 2.84375 11.8125Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="thumb-title">Thích</span>
                                    </div>
                                    <div class="helpful-thumb text-body-2 ml-3">
                                        <span class="fit-icon thumbs-icon mr-2">
                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.419563 6.18835C0.148122 6.54038 6.11959e-07 7 5.62878e-07 7.56142C2.81294e-05 8.59157 0.876996 9.54578 1.98863 9.54578L3.90679 9.54578C3.66836 10.0207 3.34091 10.6098 3.34091 11.4548C3.34089 13.0519 3.97802 14 5.60793 14C6.42811 14 6.73247 12.9632 6.88841 12.1617C6.98157 11.6829 7.06959 11.2306 7.34027 10.9599C7.98476 10.3154 8.96875 8.75 9.55987 8.43213C9.61972 8.40692 9.6962 8.38707 9.77949 8.37134C9.93735 8.60005 10.2011 8.75 10.5 8.75L13.125 8.75C13.6082 8.75 14 8.35825 14 7.875L14 0.875C14 0.391754 13.6082 -3.42482e-08 13.125 -7.64949e-08L10.5 -3.0598e-07C10.0168 -3.48226e-07 9.625 0.391754 9.625 0.875L9.625 1.11398C8.73647 1.11398 6.87184 -0.000191358 4.77272 0.00038257C4.62219 0.000300541 3.74322 -0.000438633 3.65127 0.000382472C2.03027 -1.04643e-06 1.12867 0.981667 1.18117 2.45566C0.76754 2.94038 0.564868 3.64065 0.682829 4.29056C0.342234 4.82448 0.269227 5.57763 0.419563 6.18835ZM13.125 0.875L13.125 7.875L10.5 7.875L10.5 0.875L13.125 0.875ZM1.53079 6.4435C1.09375 6.125 1.09375 4.8125 1.6841 4.51125C1.31436 3.88891 1.64713 3.05613 2.09467 2.81605C1.86791 1.37941 2.61313 0.885417 3.65906 0.875355C3.74962 0.874535 4.67753 0.875355 4.77269 0.875355C6.76684 0.875355 8.45704 1.98898 9.62497 1.98898L9.62497 7.55713C8.5939 7.55713 7.64788 9.41484 6.72153 10.3412C5.88632 11.1764 6.16473 12.5685 5.6079 13.1253C4.21586 13.1253 4.21586 12.1541 4.21586 11.4548C4.21586 10.3012 5.05107 9.78439 5.05107 8.67076L1.9886 8.67076C1.36708 8.67076 0.877707 8.11393 0.874973 7.55713C0.872266 7.00033 1.09375 6.5625 1.53079 6.4435ZM11.1563 2.1875C11.1563 1.82506 11.4501 1.53125 11.8125 1.53125C12.1749 1.53125 12.4688 1.82506 12.4688 2.1875C12.4688 2.54994 12.1749 2.84375 11.8125 2.84375C11.4501 2.84375 11.1563 2.54994 11.1563 2.1875Z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="thumb-title">Không thích</span>
                                    </div>
                                </div>

                                {{-- <div class="response-item mt-4 d-flex">
                                    <div class="left">
                                        <span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                                class="profile-pict-img img-fluid" alt="" />
                                        </span>
                                    </div>
                                    <div class="right">
                                        <h4>
                                            Gurdeep Osahan
                                            <span class="gig-rating text-body-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792"
                                                    width="15" height="15">
                                                    <path fill="currentColor"
                                                        d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z">
                                                    </path>
                                                </svg>
                                                5.0
                                            </span>
                                        </h4>
                                        <div class="country d-flex align-items-center">
                                            <span>
                                                <img class="country-flag img-fluid"
                                                    src="https://bootdey.com/img/Content/avatar/avatar3.png" />
                                            </span>
                                            <div class="country-name font-accent">India</div>
                                        </div>
                                        <div class="review-description">
                                            <p>
                                                The process was smooth, after providing the required info, Pragyesh sent
                                                me an
                                                outstanding packet of wireframes. Thank you a lot!
                                            </p>
                                        </div>
                                        <span class="publish py-3 d-inline-block w-100">Published 4 weeks ago</span>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                    @endforeach
                @endif
            </li>
        </ul>
    </div>
</div>

<div class="product__details__content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="blog__details__comment">
                <h4>Khu vực bình luận</h4>
                <div class="row justify-content-center">
                    <form method="POST" action="{{ route('client.comment.store', $id = $product->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mb-3 block-comment">
                                @if (auth()->user())
                                    <section class='rating-widget mb-3'>
                                        <div class='rating-stars text-center d-flex'>
                                            <p>Đánh giá sao :</p>
                                            <input type="hidden" class="star_rating_value" name="star">
                                            <ul id='stars'>
                                                <li class='star' title='Rất tệ' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Tệ' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Tốt' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Tuyệt' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='star' title='Cực kỳ tốt!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- <div style="display: none" class='success-box'>
                                            <div class='clearfix'></div>
                                            <img alt='tick image' width='32'
                                                src='data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA0MjYuNjY3IDQyNi42NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQyNi42NjcgNDI2LjY2NzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiM2QUMyNTk7IiBkPSJNMjEzLjMzMywwQzk1LjUxOCwwLDAsOTUuNTE0LDAsMjEzLjMzM3M5NS41MTgsMjEzLjMzMywyMTMuMzMzLDIxMy4zMzMgIGMxMTcuODI4LDAsMjEzLjMzMy05NS41MTQsMjEzLjMzMy0yMTMuMzMzUzMzMS4xNTcsMCwyMTMuMzMzLDB6IE0xNzQuMTk5LDMyMi45MThsLTkzLjkzNS05My45MzFsMzEuMzA5LTMxLjMwOWw2Mi42MjYsNjIuNjIyICBsMTQwLjg5NC0xNDAuODk4bDMxLjMwOSwzMS4zMDlMMTc0LjE5OSwzMjIuOTE4eiIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K' />
                                            <div class='text-message'></div>
                                            <div class='clearfix'></div>
                                        </div> --}}
                                    </section>
                                    <div class="col-lg-12 text-center">
                                        <textarea placeholder="Nội dung " name="comment"></textarea>
                                        <button type="submit" class="site-btn write-comment">Gửi bình
                                            luận</button>
                                    </div>
                                @else
                                    <span class="text-danger">Vui lòng đăng nhập để đánh giá sản phẩm
                                        <div class="ml-2">
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                            <a href="{{ route('account.login') }}">Đăng nhập ngay</a>
                                        </div>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
