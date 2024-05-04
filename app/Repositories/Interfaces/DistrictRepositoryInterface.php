<?php

namespace App\Repositories\Interfaces;

/**
 * Interface DistrictRepositoryInterface
 * @package App\Services\Interfaces
 */
// DistrictRepositoryInterface có trách nhiệm định nghĩa method cho Repository
interface DistrictRepositoryInterface extends BaseRepositoryInterface
{
    public function all();
    public function findDistrictByProvinceId(int $province_id);
}
