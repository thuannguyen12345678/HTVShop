<?php
namespace App\Services\User;

use App\Services\ServiceInterface;

interface UserServiceInterface extends ServiceInterface
{
    // public function trashedItems();
    // public function restore($id);
    // public function force_destroy($id);
    public function SoftDeletes($id);
    public function restore($id);
    public function trash($request);
    public function deletes($id);
    public function loginProcessing($data);
    public function logout();


}
