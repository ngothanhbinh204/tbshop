<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search"
                        id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to AdminManager.</span>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">


                        </div>
                    </li>

                    <li class="divider"></li>

                    <li class="divider"></li>

                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                    @if (session('notifications'))
                        <span class="label label-primary">
                            {{ count(session('notifications')) }}
                        </span>
                    @endif

                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    @if (session('notifications'))
                        @foreach (session('notifications') as $notification)
                            <li>
                                <div class="alert alert-{{ $notification['type'] }}" role="alert">
                                    {{ $notification['message'] }}
                                </div>
                            </li>
                        @endforeach
                        <form id="clearNotificationsForm" action="{{ route('dashboard.clearNotifications') }}"
                            method="post">
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="fa fa-times"></i>
                                Xóa Thông Báo</button>
                        </form>
                    @endif

                    <li>
                        <a href="mailbox.html">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>



                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>


            <li>
                <a href="{{ route('auth.logout') }}">
                    <i class="fa fa-sign-out"></i> Đăng Xuất
                </a>
            </li>
            <li>
                <a class="right-sidebar-toggle">
                    <i class="fa fa-tasks"></i>
                </a>
            </li>
        </ul>

    </nav>
</div>
