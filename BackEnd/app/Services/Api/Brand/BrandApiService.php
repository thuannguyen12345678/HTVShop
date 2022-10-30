<?php

namespace App\Services\Api\Brand;

use App\Repositories\api\Brand\BrandApiRepositoryInterface;
use App\Services\Api\Brand\BrandApiServiceInterface;
use App\Services\BaseService;

class BrandApiService extends BaseService implements BrandApiServiceInterface {

    public $repository;
    public function __construct(BrandApiRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;
    }
    public function trashedItems()
    {
        return $this->repository->trashedItems();

    }
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
    public function force_destroy($id)
    {
        return $this->repository->force_destroy($id);
    }
    public function searchBrand($name)
    {
        return $this->repository->searchBrand($name);
    }



}

