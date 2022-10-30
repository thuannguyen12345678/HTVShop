<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $provinces = Province::all();
        $district = District::all();
        $ward = Ward::all();
        $params = [
            'provinces' => $provinces,
            'district' => $district,
            'ward' => $ward,
        ];
        return response()->json($params);
    }

    function getAllProvince() {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    function getAllDistrictByProvinceId($id) {
        $districts = District::where('province_id', '=', $id)->get();
        return response()->json($districts);
    }
    function getAllWardByDistrictId($id) {
        $wards = Ward::where('district_id', '=', $id)->get();
        return response()->json($wards);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $order = new Order;
        $order->note = $request->note;
        $order->name_customer = $request->name_customer;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->order_total_price = $request->order_total_price;
        $order->customer_id = $request->customer_id;
        $order->province_id = $request->province_id;
        $order->district_id = $request->district_id;
        $order->ward_id = $request->ward_id;
        $order->save();
        $carts = Cache::get('carts');
        $order_total_price = 0;
        foreach ($carts as $productId => $cart) {
            $order_total_price += $cart['price'] * $cart['amount'];
            OrderDetail::create([
                'product_price' => $cart['price'],
                'product_quantity' => $cart['amount'],
                'product_total_price' => $cart['price'] * $cart['amount'],
                'product_id' => $productId,
                'order_id' => $order->id,
            ]);
            Product::where('id', $productId)->decrement('amount', $cart['amount']);
        }
        $order->order_total_price = $order_total_price;
        $order->save();
        Cache::forget('carts');
        $carts = Cache::get('carts');
        try{
            return response()->json(Order::with(['orderDetails'])->find($order->id));
        }catch(\Exception $e){
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return response()->json(Order::with(['province', 'district', 'ward', 'oderDetails' => function ($query) {
            return $query->with(['products']);
        }])->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}