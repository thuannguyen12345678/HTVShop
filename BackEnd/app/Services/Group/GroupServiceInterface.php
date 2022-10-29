<?php
namespace App\Services\Group;

use App\Services\ServiceInterface;

interface GroupServiceInterface extends ServiceInterface
{
    // public function trashedItems();
    // public function restore($id);
    // public function force_destroy($id);
    public function SoftDeletes($id);
    public function restore($id);
    public function trash($request);
    public function deletes($id);
}
