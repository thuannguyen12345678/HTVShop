<?php

namespace App\Services\Api\Product;

use App\Services\Api\BaseService;
use App\Repositories\Api\Product\FeProductRepositoryInterface;

class FeProductService extends BaseService implements FeProductServiceInterface {

    public $repository;
    public function __construct(FeProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function search($request)
    {
        return $this->repository->search($request);
    }
    public function find($id)
    {
        return $this->repository->find($id);
    }
    public function find_images($id)
    {
        return $this->repository->find_images($id);
    }
    public function trendingProduct()
    {
        return $this->repository->trendingProduct();
    }
    public function countReviewStar($id){
        return $this->repository->countReviewStar($id);

    }


}