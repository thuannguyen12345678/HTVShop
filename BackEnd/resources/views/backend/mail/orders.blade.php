<div>
    @if (isset($params['order']) && isset($params['orderDetails']))
        @php
            $order = $params['order'];
            $orderDetails = $params['orderDetails'];
            $orderStatus = $params['orderStatus'];
            $totalPriceOrder = 0;
        @endphp
    @endif
</div>
<p>Chúc bạn có một ngày làm việc vui vẻ!</p>
<tr>
    <td colspan="2" style="padding:0 0 1px 0;color:#153643;">
        <h1 style="font-size:24px;margin:0 0 -40px 0;font-family:Arial,sans-serif;">
            <h3>Kính Chào Khách Hàng: {{ $order->name_customer }}</h3>
        </h1>
        <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:rgb(241, 23, 63)">{{$orderStatus}}</p><br>
<tr>
    <td style="width: 200px"><b>Sản phẩm</b></td>
    <td style="width: 100px"><b>Số Lượng</b></td>
    <td style="width: 100px"><b>Giá</b></td>
    <td style="width: 100px"><b>Tổng Phụ</b></td>
</tr>
@foreach ($orderDetails as $orderDetail)
    <tr>
        <td>{{ $orderDetail->products->name }}</td>
        <td>{{ $orderDetail->product_quantity }} Cái</td>
        <td>{{ number_format($orderDetail->product_price) }} VNĐ</td>
        <td>{{ number_format($orderDetail->product_price * $orderDetail->product_quantity) }} VNĐ</td>
        @php
            $totalPriceOrder += $orderDetail->product_price * $orderDetail->product_quantity;
        @endphp
    </tr>
@endforeach
<tr>
    <td colspan="3"><br><b>Tổng Tiền Cần Thanh Toán:</b></td>
    <td><br><b style="color:rgb(34, 0, 255) ">{{ number_format($totalPriceOrder) }} VNĐ</b><br></td>
</tr>
</td>
<p>Shop HTVStore Cảm Ơn Bạn Đã Đến!</p>
<p>------</p>
<h4>Nguyễn Đức Thuần (Mr.)</h4>
<label>T: <a href="tel:0327228878" style="color:rgb(17,85,204)" target="_blank">(84) 327228878</a>
    | E: <a href="mailto:nguyenducthuan0303@gmail.com" style="color:rgb(17,85,204)"
        target="_blank">nguyenducthuan0303@gmail.com</a>
</label>
<h3>Shop | W: <a href="http://127.0.0.1:8000/" style="color:rgb(17,85,204)" target="_blank">HTVStore</a></h3>
<label>133 Lý Thường Kiệt, Đông Lương, Đông Hà, Quảng Trị |
    <a href="https://www.google.com/maps/place/133+L%C3%BD+Th%C6%B0%E1%BB%9Dng+Ki%E1%BB%87t,+%C4%90%C3%B4ng+H%E1%BA%A3i,+%C4%90%C3%B4ng+H%C3%A0,+Qu%E1%BA%A3ng+Tr%E1%BB%8B,+Vi%E1%BB%87t+Nam/@16.802374,107.1092616,17z/data=!3m1!4b1!4m5!3m4!1s0x3140e584960ba903:0x5c5e139c80555b93!8m2!3d16.8023689!4d107.1114503"
        style="color:rgb(17,85,204)" target="_blank">Xem Bản Đồ</a>
</label>
