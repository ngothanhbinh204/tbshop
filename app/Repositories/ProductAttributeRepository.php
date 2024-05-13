<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ProductAttributeRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductAttribute;
/**
 * Class ProductAttributeService
 * @package App\Repositories
 */
class ProductAttributeRepository extends BaseRepository implements ProductAttributeRepositoryInterface
{

    protected $model;

    public function __construct(
        ProductAttribute $model
    ) {
        $this->model = $model;
    }   
}
