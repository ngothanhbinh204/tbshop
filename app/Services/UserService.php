<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Models\User;


/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function paginate()
    {
        $users = $this->userRepository->getAllPaginate();
        return $users;
    }

    public function create(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            // dd($request);
            $payload = $request->except('_token', 're_password');
            $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
            $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
            $payload['password'] = Hash::make($payload['password']);
         //  dd($payload);
            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            die();
            return false;
        }
        
    }

    public function findById(int $id, array $column = [], array $relation = [])
    {
        $query = User::query();
        if (!empty($relation)) {
            $query->with($relation);
        }
        $query->leftJoin('provinces', 'users.province_id', '=', 'provinces.code')
            ->leftJoin('districts', 'users.district_id', '=', 'districts.code')
            ->leftJoin('wards', 'users.ward_id', '=', 'wards.code')
            ->select($column)
            ->where('users.id', $id);
        return $query->firstOrFail();
    }

    public function update(array $payload, int $id)
    {
        return $this->userRepository->update($payload, $id);
    }

    public function updateAvatar($payload, int $id)
    {
        return $this->userRepository->updateAvatar($payload, $id);
    }
}
