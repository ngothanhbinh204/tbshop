@php
    $roleLabels = [
        'Quản trị viên' => 'danger',
        'Cộng tác viên' => 'info',
        'Biên tập viên' => 'success',
    ];
@endphp

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

                                        <td>
                                            {{ $user->username }}
                                        </td>
                                        <td> {{ $user->email }}</td>
                                        <td> {{ $user->phone }}</td>
                                        <td> {{ $user->address }}</td>

                                        <td>
                                            @if (isset($user->role) && array_key_exists($user->role->name, $roleLabels))
                                                <span class="label label-{{ $roleLabels[$user->role->name] }}">
                                                    {{ $user->role->name }}
                                                </span>
                                            @else
                                                <span class="label">
                                                    Chưa xác định
                                                </span>
                                            @endif

                                        </td>
                                        <td class="text-center">
                                            <input value="{{ $user->status }}" type="checkbox" class="js-switch status"
                                                name="" id="" data-field="status"
                                                data-modelid="{{ $user->id }}" data-model="User"
                                                {{ $user->status == 1 ? 'checked' : '' }}>
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
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>


