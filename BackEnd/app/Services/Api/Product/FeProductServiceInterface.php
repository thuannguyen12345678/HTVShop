<?php
namespace App\Services\Api\Product;


interface FeProductServiceInterface
{
    public function getAll();
    public function search($request);
    public function find($id);
    public function trendingProduct();
    public function countReviewStar($id);
    public function find_images($id);
}