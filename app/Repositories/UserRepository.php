<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    public function getAllPaginate()
    {
        return User::paginate(10);
    }

    // public function update(array $payload, int $id)
    // {
    //     $user = $this->model->findOrFail($id);
    //     $carbonDate = Carbon::createFromFormat('Y-m-d', $payload['birthday']);
    //     $payload['birthday'] = $carbonDate->format('Y-m-d H:i:s');
    //     // dd($payload);
    //     $user->update($payload);
    //     session()->push('notifications', ['message' => 'Cập nhật người dùng thành công : ' . $user->username . ' ', 'type' => 'success']);

    //     return $user;
    // }


    public function updateAvatar($payload, int $id)
    {
        $user = $this->model->findOrFail($id);

        if ($user && isset($payload)) {
            $avatar = $payload;
            if ($avatar->isValid()) {
                $path = $avatar->store('avatars', 'public');
                $user->image = basename($path);
                // dd($path);
            } else {
                throw new \Exception('upload thất bại');
            }
        }

        $user->save();

        return $user;
    }
}
