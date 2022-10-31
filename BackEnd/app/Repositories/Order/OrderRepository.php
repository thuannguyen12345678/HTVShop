<?php
namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    function getModel(){
        return Order::class;
    }
    // public function all($request)
    // {
    //     return  $this->model->latest()->paginate(10);
    // }
    public function all($request)
    {
        $search = $request->search;
        $orders = $this->model->select('*')->orderBy('id', 'desc');
        if ($search) {
            $orders = $orders->where('phone', 'like', '%' . $search . '%');
        }
        return $orders->paginate(5);
    }
    // function getAllWithPaginateLatest($request){
    //     $orders = $this->model->latest()->paginate(10);
    //     if(isset($request->search)){
    //         $orders = $this->model
    //         ->Where('phone', 'LIKE', '%'.$request->search.'%')
    //         ->paginate(10);
    //     }
    //     return $orders;
    // }
    function updateSingle($id){
        $order = $this->model->find($id);
        $order->update(['status' => 1]);
        return $order;
    }
}