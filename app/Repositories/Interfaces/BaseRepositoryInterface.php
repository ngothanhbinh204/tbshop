<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseRepositoryInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function all();
    public function findByID(
        int $modelID,
        array $column = [],
        array $relation = []
    );
    public function create($payload);
    public function update($payload, $id);
}
