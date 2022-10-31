<?php
namespace App\Services\Api\Brand;

use App\Services\ServiceInterface;

interface BrandApiServiceInterface extends ServiceInterface
{
    public function trashedItems();
    public function restore($id);
    public function force_destroy($id);
    public function searchBrand($name);


}