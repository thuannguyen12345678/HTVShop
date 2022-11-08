@extends('backend.master')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
       <div class="row column_title">
          <div class="col-md-12">
             <div class="page_title">
                <h2>Trang Tổng Quan</h2>
             </div>
          </div>
       </div>
       <div class="row column1">
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div>
                   </div>
                </div>
                <div class="counter_no">
                   <div>
                      <p class="total_no"><h2>{{number_format($totalPrice)}}.Vnđ</h2></p>
                      <p class="head_couter">Doanh Thu</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div>
                   </div>
                </div>
                <div class="counter_no">
                   <div style="text-align: center">
                      <p class="total_no" ><h2>{{number_format($ordercount)}}</h2></p>
                      <p class="head_couter">Số Đơn hàng</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div>
                   </div>
                </div>
                <div class="counter_no" >
                   <div style="text-align: center">
                      <p class="total_no"><h2>{{number_format($customercount)}}</h2></p>
                      <p class="head_couter">Số Khách Hàng</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div>
                   </div>
                </div>
                <div class="counter_no" >
                   <div style="text-align: center">
                      <p class="total_no"><h2>{{number_format($usercount)}}</p>
                      <p class="head_couter">Số Nhân Viên</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- graph -->

       <!-- end graph -->
       <div class="row column4 graph">
          <div class="col-md-6 margin_bottom_30">
             <div class="dash_blog">
                <div class="dash_blog_inner">
                   <div class="dash_head">
                      <h3><span><i class="fa fa-calendar"></i>Top Các Khách Hàng Thân Thiết</span><span class="plus_green_bt"></span></h3>
                   </div>
                   <div class="list_cont">

                   </div>
                   <div class="task_list_main">
                      <ul class="task_list">
                        @foreach ( $customerPro as $customer )
                         <li><a href="#">{{ $customer->email }}</a><br><strong>{{ $customer->phone }}</strong></li>
                         @endforeach
                      </ul>
                   </div>

                </div>
             </div>
          </div>
          <div class="col-md-6">
             <div class="dash_blog">
                <div class="dash_blog_inner">
                   <div class="dash_head">
                      <h3><span><i class="fa fa-comments-o"></i>Top Sản Phẩm Bán Chạy </span><span class="plus_green_bt"></span></h3>
                   </div>
                   <div class="list_cont">
                   </div>
                   <div class="msg_list_main">
                      <ul class="msg_list">
                        @foreach ($productPro as $product )
                         <li>
                            <span><img src="{{ asset($product->image) }}" class="img-responsive" alt="#" /></span>
                            <span>
                            <span class="name_user">{{ $product->name }}</span>
                            <span class="msg_user">{{ number_format($product->price)  }}.vnđ</span>
                            <span class="time_ago">12 min ago</span>
                            </span>
                         </li>
                          @endforeach
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- footer -->
    <div class="container-fluid">
       <div class="footer">
          <p>Bản quyền © 2018 Được thiết kế bởi html.design. Đã đăng ký Bản quyền.<br><br>
            Phân phối bởi: <a href="https://themewagon.com/">ThemeWagon</a>
          </p>
       </div>
    </div>
 </div>

@endsection
