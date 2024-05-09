<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Base;

/**
 * Class BaseService
 * @package App\Repositories
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    // lưu các phương thức cơ bản của province, district, ward...
    public function create($payload)
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findByID(
        int $modelID,
        array $column = [],
        array $relation = []
    ) {
        return $this->model->select($column)->with($relation)->findOrFail($modelID);
    }
}
