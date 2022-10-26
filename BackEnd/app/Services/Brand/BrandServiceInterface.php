<?php
namespace App\Services\Brand;

use App\Services\ServiceInterface;

interface BrandServiceInterface extends ServiceInterface
{
    public function trashedItems();
    public function restore($id);
    public function force_destroy($id);
    public function searchBrand($name);
}