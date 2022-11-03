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
        $key        = $request->key ?? '';
        $name_customer      = $request->name_customer ?? '';
        $phone      = $request->phone ?? '';
        $address      = $request->address ?? '';
        $created_at      = $request->created_at ?? '';
        $id         = $request->id ?? '';
        $query = Order::query(true);
        $query->orderBy('id', 'desc');
        if ($name_customer) {
            $query->where('name_customer', 'LIKE', '%' . $name_customer . '%');
        }
        if ($phone) {
            $query->where('phone', 'LIKE', '%' . $phone . '%');
        }
        if ($address) {
            $query->where('address', 'LIKE', '%' . $address . '%');
        }
        if ($created_at) {
            $query->where('created_at', 'LIKE', '%' . $created_at . '%');
        }
        if ($id) {
            $query->where('id', $id);
        }
        if ($key) {
            $query->orWhere('id', $key);
            $query->orWhere('name_customer', 'LIKE', '%' . $key . '%');
            $query->orWhere('created_at', 'LIKE', '%' . $key . '%');
            $query->orWhere('phone', 'LIKE', '%' . $key . '%');
            $query->orWhere('address', 'LIKE', '%' . $key . '%');
        }
        return $query->paginate(5);
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