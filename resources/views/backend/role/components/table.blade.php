@php
    $roleLabels = [
        'Khách hàng' => 'warning',
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
                                <th>Tên nhóm thành viên </th>
                                <th>Số lượng thành viên </th>
                                <th>Mô tả</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($roles) && is_object($roles))
                                @foreach ($roles as $role)
                                    <tr>

                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td> {{ $role->name }}</td>
                                        <td> {{ $role->description }}</td>
                                       
                                        <td>
                                            <a href="{{ route('role.update', ['id' => $role->id]) }}"
                                                class="btn btn-circle btn-primary dim">
                                                <i class="fa fa-edit">
                                                </i>
                                            </a>
                                            <form action="{{ route('role.delete', ['id' => $role->id]) }}"
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

