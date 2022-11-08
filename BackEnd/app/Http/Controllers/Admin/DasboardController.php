<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DasboardController extends Controller
{
    public function index(){
        $productPro = DB::table('order_details')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->selectRaw('products.*, count(order_details.product_id) totalByQuan')
        ->groupBy('order_details.product_id')
        ->orderBy('totalByQuan', 'DESC')
        ->take(5)
        ->get();
        $customerPro = DB::table('order_details')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
        ->selectRaw('customers.*, count(orders.customer_id) totalByQuan')
        ->groupBy('orders.customer_id')
        ->orderBy('totalByQuan', 'DESC')
        ->take(5)
        ->get();
        $totalPrice  =  OrderDetail::pluck('product_price')->sum();
        $usercount  =  User::pluck('name')->count();
        $customercount  =  Customer::pluck('name')->count();
        $ordercount  =  Order::pluck('id')->count();
        $params = [
           'productPro'=>$productPro,
           'customerPro'=> $customerPro,
           'totalPrice'=>$totalPrice,
           'usercount'=>$usercount,
           'customercount'=>$customercount,
           'ordercount'=>$ordercount,
        ];
        return view('Backend.dashboard.index',$params);
    }
}
