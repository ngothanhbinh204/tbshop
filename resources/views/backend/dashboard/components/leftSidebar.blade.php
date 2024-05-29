<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">

                @if (Auth::check())
                    <div class="dropdown profile-element">
                        @if (Auth::user()->image)
                            <img width="45%" class="img-circle circle-border m-b-md" alt="profile"
                                src="{{ asset('storage/avatars/' . Auth::user()->image) }}" alt="Avatar">
                        @else
                            <img width="45%" src="{{ asset('storage/avatars/default.jpg') }}"
                                class="img-circle circle-border m-b-md" alt="profile">
                        @endif
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                        class="font-bold">{{ Auth::user()->username }}</strong>
                                </span> <span class="text-muted text-xs block">{{ Auth::user()->role->name }} <b
                                        class="caret"></b></span>
                            </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                @endif
            </li>
            <li class="">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="nav-label">Trang quản trị</span>
                </a>
            </li>
            <li class="">
                <a href=""><i class="fa fa-users"></i> <span class="nav-label">QL nhóm Thành Viên</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('user.index') }}">Danh sách thành viên</a></li>
                    <li class=""><a href=" {{ route('user.create') }}">Thêm thành viên</a></li>
                    <li class=""><a href=" {{ route('role.index') }}">Q.Lý nhóm thành viên</a></li>

                </ul>
            </li>

            <li class="">
                <a href=""><i class="fa fa-cube"></i> <span class="nav-label">Q.Lý nhóm sản phẩm</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('product.index') }}">Danh sách sản phẩm</a></li>
                    <li class=""><a href=" {{ route('product.create') }}">Thêm sản phẩm</a></li>
                    <li> <a href=" {{ route('category.index') }}"> <i class="fa fa-archive"></i>Danh mục sản phẩm</a></li>


                </ul>
            </li>

            <li class="">
                <a href=""><i class="fa fa-file"></i> <span class="nav-label">Q.Lý nhóm bài viết</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('post.index') }}">Danh sách bài viết</a></li>
                    <li class=""><a href=" {{ route('post.create') }}">Thêm bài viết</a></li>
                    <li class=""><a href=" {{ route('post.create') }}">Danh mục bài viết</a></li>

                </ul>
            </li>
    
            <li class="">
                <a href=""><i class="fa fa-gears"></i> <span class="nav-label">Q.Lý thuộc tính sản phẩm</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('attribute.index') }}">Danh sách thuộc tính</a></li>
                </ul>
            </li>
            <li class="">
                <a href=""><i class="fa fa-shopping-cart"></i> <span class="nav-label">Q.Lý đơn hàng</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('orders.index') }}">Danh sách đơn hàng</a></li>
                    <li class=""><a href="">Đơn hàng huỷ</a></li>
                </ul>
            </li>
            <li class="">
                <a href=""><i class="fa fa-ticket"></i> <span class="nav-label">Q.Lý Coupons</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('orders.index') }}">Danh sách Coupons</a></li>
                    <li class=""><a href="">Thêm Coupon</a></li>

                </ul>
            </li>
            <li class="">
                <a href=""><i class="fa fa-picture-o"></i> <span class="nav-label">Q.Lý Slider</span>
                    <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href=" {{ route('orders.index') }}">Danh sách Slider</a></li>
                    <li class=""><a href="">Thêm Slider</a></li>

                </ul>
            </li>
        </ul>

    </div>
</nav>
