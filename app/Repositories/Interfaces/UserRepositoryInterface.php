<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\StoreUserRequest;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserRepositoryInterface
{
    public function getAllPaginate();
    public function create($payload);

    public function update(array $payload, int $id);

    public function updateAvatar($path, int $id);

    public function findById(
        int $modelID,
        array $column = [],
        array $relation = []
    );
}
