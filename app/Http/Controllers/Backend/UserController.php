<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Requests\UpdateUserRequest;



use Illuminate\Support\Facades\Config;


class UserController extends Controller
{

    protected $userService;
    protected $provinceReponsitory;
    public function __construct(
        UserService $userService,
        ProvinceService $provinceReponsitory

    ) {
        $this->userService = $userService;
        $this->provinceReponsitory = $provinceReponsitory;
    }

    public function index(Request $request)
    {
        $template = 'backend.user.index';
        // Lấy danh sách user roles
        $roles = Role::all();
        // Bắt đầu query users từ bảng 'users'
        $usersQuery = User::with(['province', 'district', 'ward', 'role']);

        // Tìm kiếm user
        if ($request->has('keywords')) {
            $keywords = $request->keywords;
            if (!empty($request->keywords)) {
                $usersQuery->where(function ($query) use ($keywords) {
                    $query->where('username', 'like', "%$keywords%")
                        ->orWhere('email', 'like', "%$keywords%");
                });
                // dd($request->keywords);
            }
        }

        // lọc user theo role
        if ($request->has('user_role')) {
            if ($request->user_role !== null) {
                $usersQuery->where('user_role', $request->user_role);
            }
            // dd($request->user_role);
        }

        // lọc user theo status
        if ($request->has('status')) {
            $status = $request->status == 'active' ? 1 : ($request->status == 'inactive' ? 0 : null);
            if ($status !== null) {
                $usersQuery->where('status', $status);
            }
            // dd($status);
        }
        $users = $usersQuery->orderByDesc('user_role')->paginate(10);
        return view('backend.dashboard.layout', compact(
            'template',
            'users',
            'roles'
        ));
    }

    public function create(Request $request)
    {
        $template = 'backend.user.create';
        $roles = Role::all();
        $provinces = $this->provinceReponsitory->all();
        return view('backend.dashboard.layout', compact(
            'provinces',
            'roles',
            'template'
        ));
    }

    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            session()->push('notifications', ['message' => 'Thêm người dùng thành công', 'type' => 'success']);
            return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
        }
    }

    public function edit(Request $request, $id)
    {
        $template = 'backend.user.edit';
        $provinces = $this->provinceReponsitory->all();
        $user = $this->userService->findById($id, [
            'users.*',
            'provinces.name as province_name',
            'districts.name as district_name',
            'wards.name as ward_name'
        ], ['role']);
        //  dd($user);
        $user->birthday = date('Y-m-d', strtotime($user->birthday));
        return view('backend.dashboard.layout', compact(
            'template',
            'provinces',
            'user'
        ));
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
        $payload = $request->except('_token', '_method');
        $user = $this->userService->update($payload, $id);
        return redirect()->route('user.edit', $user->id)->with('success', 'Cập nhật người dùng thành công');
    }

    public function updateAvatar(UploadImageRequest $request, $id)
    {
        try {
            $payload = $request->file('image');
            $image = $this->userService->updateAvatar($payload, $id);

            session()->push('notifications', ['message' => 'Cập nhật ảnh đại diện thành công', 'type' => 'success']);
            return back()->with('success', 'Cập nhật ảnh đại diện thành công');
        } catch (\Throwable $th) {
            session()->push('notifications', ['message' => 'Cập nhật ảnh đại diện thất bại', 'type' => 'error']);
            return back()->with('error', 'Cập nhật ảnh đại diện không thành công');
        }
    }

    public function updateStatus($post = [])
    {
        $payload = [
            $post['field'] => (($post['value'] == 1) ? 0 : 1)
        ];
        $user = User::findOrFail($post['modelId']);
        $user->update($payload);
        session()->push('notifications', ['message' => 'Cập nhật trạng thái người dùng thành công : ' . $user->username . ' ', 'type' => 'success']);
        return redirect()->route('user.edit', $user->id);
    }

    public function deleteUser($id)
    {
        // echo 1;
        // die();
        $user = User::findOrFail($id);
        // Xóa người dùng
        $user->delete();
        session()->push('notifications', ['message' => 'Người dùng đã được xóa thành công : ' . $user->username . ' ', 'type' => 'success']);
        return redirect()->route('user.index')->with('success', 'Người dùng đã được xóa thành công');
    }
}
