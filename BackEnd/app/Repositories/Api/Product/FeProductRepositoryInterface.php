<?php
namespace App\Repositories\Api\Product;

use App\Repositories\Api\RepositoryInterface;

interface FeProductRepositoryInterface extends RepositoryInterface{
    public function getAll();
    public function search($request);
    public function find($id);
    public function trendingProduct();
    public function countReviewStar($id);
    public function find_images($id);

}