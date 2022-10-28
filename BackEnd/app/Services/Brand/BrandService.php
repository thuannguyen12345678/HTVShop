<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\BaseService;

class BrandService extends BaseService implements BrandServiceInterface {

    public $repository;
    public function __construct(BrandRepositoryInterface $brandRepository)
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

