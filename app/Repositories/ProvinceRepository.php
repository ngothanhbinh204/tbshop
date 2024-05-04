<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Province;

/**
 * Class ProvinceService
 * @package App\Repositories
 */
class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    protected $model;
    public function __construct(
        // Province không còn Method all() -> chuyển sang BaseRepo để sử lý
        Province $model
    ) {
        $this->model = $model;
    }
}
