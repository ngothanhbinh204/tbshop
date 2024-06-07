<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Monthly</span>
                    <h5>Doanh thu</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">40 886,200</h1>
                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                    <small>Tổng doanh thu</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Annual</span>
                    <h5>Đơn hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">275,800</h1>
                    <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                    <small>Đơn hàng mới</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Today</span>
                    <h5>Truy cập</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">106,120</h1>
                    <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                    <small>Đang online</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right">Low value</span>
                    <h5>Người dùng kích hoạt</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
                    <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                    </div>
                    <small>In first month</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Thống kê --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thống kê đơn hàng</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                {{-- <div class="flot-chart-content" id="flot-dashboard-chart"></div> --}}
                                <form autocomplete="off">
                                    @csrf
                                    <input type="hidden" class="actionUrlDefaul"
                                        data-action="{{ route('dashboard_get60DaysOrder') }}">
                                    <div class="col-md-4">
                                        <p>Từ ngày :
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" id="dateStart" class="form-control" value="">
                                        </div>
                                        </p>
                                        <input type="button" id="btn-dashboard-filter"
                                            data-action="{{ route('orders.filter_by_date') }}"
                                            class="btn btn-primary btn-sm" value="Lọc kết quả">
                                    </div>

                                    <div class="col-md-4">
                                        <p>Đến ngày :
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" id="dateEnd" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p>Lọc theo :
                                        <div class="input-group ">
                                            <select data-action="{{ route('dashboard_filter') }}"
                                                class=" dashboard-filter form-control" name="" id="">
                                                <option> [Chọn] </option>
                                                <option value="7ngay">7 ngày qua</option>
                                                <option value="thangtruoc">Tháng trước</option>
                                                <option value="thangnay">Tháng này</option>
                                                <option value="365ngayqua">365 ngày qua</option>

                                            </select>
                                        </div>
                                        </p>
                                    </div>

                                </form>

                                <div class="col-md-12">
                                    <div id="myfirstchart" style="height: 250px;"></div>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i>
                                    </div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thống kê lượt truy cập</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                            <tr>
                                <th>Đang online</th>
                                <th>Tổng tháng trước</th>
                                <th>Tổng tháng này</th>
                                <th>Tổng 1 năm</th>
                                <th>Tổng truy cập</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $visitor_count }}</td>
                                <td>{{ $visitor_lastmonth_count }}</td>
                                <td>{{ $visitor_thismonth_count }}</td>
                                <td>{{ $visitor_year_count }}</td>
                                <td>{{ $visitors_total }}</td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Thống kê sản phẩm, bài viết , ..</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="morris-donut-chart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Danh sách user mới nhất</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Người dùng</th>
                                        <th>Thành phố</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($user_new))
                                        @foreach ($user_new as $item)
                                            @if ($item->user_role != 1)
                                                <tr>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="label label-info">Hoạt động</span>
                                                        @else
                                                            <span class="label label-warning">Không hoạt động</span>
                                                        @endif
                                                    </td>
                                                    <td><i class="fa fa-clock-o"></i>
                                                        {{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                                    <td>{{ $item->username }}</td>
                                                    <td class="text-navy"> <i class="fa fa-level-up"></i>
                                                        {{-- {{ $item->province->name }} </td> --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Thống kê lượt xem</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Sản phẩm nhiều lượt xem</h3>
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%" class="text-center">ID</th>
                                                <th>Tên sản phẩm</th>
                                                <th class="text-center">Views</th>
                                                <th class="text-center">Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($product_views))
                                                @foreach ($product_views as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->id }}</td>
                                                        <td> <a
                                                                href="{{ route('product.productAttributes', $id = $item->id) }}">
                                                                {{ Str::limit($item->name, 20) }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center small">{{ $item->views }}</td>
                                                        <td class="text-center"><span class="label label-primary">
                                                                {{ number_format($item->attribute[0]->pivot->price, 0, ',', '.') }}
                                                                đ
                                                            </span>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            @endif


                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <h3>Bài viết nhiều lượt xem</h3>
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%" class="text-center">ID</th>
                                                <th>Tiêu đề</th>
                                                <th class="text-center">Views</th>
                                                <th class="text-center">Tác giả</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($post_views))
                                                @foreach ($post_views as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $item->id }}</td>
                                                        <td> <a href="{{ route('post.detail', $id = $item->id) }}">
                                                                {{ Str::limit($item->title, 20) }}
                                                            </a>
                                                        </td>
                                                        <td class="text-center small">{{ $item->views }}</td>
                                                        <td class="text-center">
                                                            {{ $item->users->username }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Truyền các biến PHP vào JavaScript
    var productCount = {{ $product }};
    var postCount = {{ $post }};
    var orderCount = {{ $order }};
    var userCount = {{ $users }};
    var productViews = @json($product_views);
    var postViews = @json($post_views);
</script>
