<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreUserRequest;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate();
    public function create(StoreUserRequest $request);
    public function createClient($data);
    public function getById(int $id);
    public function update(array $payload, int $id);

    public function updateAvatar($payload, int $id);

    public function findByID(
        int $modelID,
        array $column = [],
        array $relation = []
    );
}
