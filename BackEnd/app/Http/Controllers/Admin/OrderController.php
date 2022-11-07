<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $orderService;
    function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Order::class);
        // if (Gate::denies('List_Order', 'List_Order')) {
        //     abort(403);
        // }
        $orders = $this->orderService->all($request);
        $params = [
            'orders' => $orders,
        ];
        return view('backend.orders.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Order::class);
        $order = $this->orderService->find($id);
        $orderDetails = $order->orderDetails;
        $params = [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ];
        return view('backend.orders.show', $params);
    }

    function updateSingle($id)
    {
        // $this->authorize('status', Order::class);
        try {
            $this->orderService->updateSingle($id);
            $order = $this->orderService->find($id);
            $customer = Customer::findOrFail($order->customer_id);
            $orderDetails = $order->orderDetails;
            $orderStatus = 'Đơn hàng của bạn đã được duyệt';
            $params = [
                'order' => $order,
                'orderStatus' => $orderStatus,
                'orderDetails' => $orderDetails,
            ];
            Mail::send('backend.mail.orders', compact('params'), function ($email) use ($customer) {
                $email->subject('HTVStore');
                $email->to($customer->email, $customer->name);
            });
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            Log::error('message: ' . $e->getMessage() . 'line: ' . $e->getLine() . 'file: ' . $e->getFile());
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
