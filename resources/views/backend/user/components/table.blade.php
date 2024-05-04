<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5> {{ $table }} </h5>
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tên người dùng </th>
                                <th>Email </th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th>Chức vụ</th>
                                <th>Trạng Thái</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users) && is_object($users))
                                @foreach ($users as $user)
                                    <tr>
                                        <td><input type="checkbox" checked class="i-checks" name="input[]"></td>
                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td> {{ $user->email }}</td>
                                        <td> {{ $user->phone }}</td>
                                        <td> {{ $user->address }}</td>

                                        <td>
                                            @if (isset($user->role))
                                                {{-- Admin --}}
                                                @if ($user->role->name == 'Quản trị viên')
                                                    <span class="label label-danger">{{ $user->role->name }}</span>
                                                    {{-- Cộng tác viên --}}
                                                @elseif ($user->role->namee == 'Cộng tác viên')
                                                    <span class="label label-info">{{ $user->role->name }}</span>
                                                    {{-- Biên tập viên --}}
                                                @elseif ($user->role->name == 'Biên tập viên')
                                                    <span class="label label-success">{{ $user->role->name }}</span>
                                                @else
                                                    {{-- Khách hàng --}}
                                                    <span class="label ">{{ $user->role->name }}</span>
                                                @endif
                                            @else
                                                <span class="label">Chưa xác định</span>
                                            @endif
                                        </td>
                                        <td>
                                            {!! $user->status == 0
                                                ? '<input type="checkbox" class="js-switch" />'
                                                : '<input type="checkbox" class="js-switch" checked />' !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.edit', ['id' => $user->id]) }}"
                                                class="btn btn-circle btn-primary dim">
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <form action="{{ route('user.delete', ['id' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-circle btn-danger">
                                                    <i class="fa fa-trash ">
                                                    </i>
                                                </button>
                                            </form>
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

{{ $users->links('pagination::bootstrap-4') }}
