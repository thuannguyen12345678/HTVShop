@extends('backend.master')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('customers.index') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quay Lại</a>
                </li>
            </ol>
        </nav>
    </header>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>Tên khách hàng :</p>
                        <h4><strong>{{ $customers->name }}</strong></h4>
                        <p>Số điện thoại : </p>
                        <h4><strong>{{ $customers->phone }}</strong></h4>
                        <p>Email : </p>
                        <h4><strong>{{ $customers->email }}</strong></h4>
                        <p>Tỉnh, Thành Phố : </p>
                        <h4><strong>{{ $customers->province->name }}</strong></h4>
                        <p>Quận, Huyện : </p>
                        <h4><strong>{{ $customers->district->name }}</strong></h4>
                        <p>Phường, Xã : </p>
                        <h4><strong>{{ $customers->ward->name }}</strong></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
