<?php
namespace App\Repositories\Api\Brand;

use App\Repositories\RepositoryInterface;

interface BrandApiRepositoryInterface extends RepositoryInterface{
    public function trashedItems();
    public function restore($id);
    public function force_destroy($id);
    public function searchBrand($name);




}