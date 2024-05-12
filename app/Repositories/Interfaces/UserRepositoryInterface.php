<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreUserRequest;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllPaginate();

    public function updateAvatar($path, int $id);
}
