<?php
namespace App\Repositories\Brand;

use App\Repositories\RepositoryInterface;

interface BrandRepositoryInterface extends RepositoryInterface{
    public function trashedItems();
    public function restore($id);
    public function force_destroy($id);
    public function searchBrand($name);
  



}