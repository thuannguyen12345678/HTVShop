<?php
namespace App\Repositories\Order;

use App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface{
    function all($request);
    function updateSingle($id);
}