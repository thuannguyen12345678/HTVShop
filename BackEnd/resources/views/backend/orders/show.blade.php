@extends('backend.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>Khách hàng : </p>
                        <h4><strong>{{ $order->customer->name }}</strong></h4>
                        <p>Số điện thoại : </p>
                        <h4><strong>{{ $order->phone }}</strong></h4>
                        <p>Tổng tiền hóa đơn : </p>
                        <h4><strong>{{ number_format($order->order_total_price)}} đ</strong></h4>
                        <p>Ghi chú :</p>
                        <h4><strong>{{ $order->note }}</strong></h4>
                        <p>Địa chỉ : </p>
                        <h4><strong>{{ $order->address }}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
