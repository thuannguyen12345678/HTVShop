@extends('backend.master')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="col-md-12 d-flex">
                <div class="md-3">
                    <a href="{{ route('customers.index') }}" class="btn btn-danger btn-rounded waves-effect waves-light ">
                        <i class=" fas fa-reply-all"></i>
                        Quay Lại</a>
                </div>
            </div>
            <!-- Title -->
            <div class="mb-3 text-center">
                <h2>Chi Tiết Khách Hàng</h2>
            </div>
            <div class="d-flex justify-content-between align-items-center py-3">
                <h5>ID Khách Hàng: {{ $customers->id }}</h5>
            </div>
            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4" style="width: 1200px;height: auto;">
                        <div class="card-body">
                            <div class="mb-3">
                                <span class="me-3"> Tên Khách Hàng: <b>{{ $customers->name }}</b></span>
                            </div>
                            <div class="mb-3">
                                <span class="me-3">Số điện thoại :
                                    <b> {{ $customers->phone }}</b>
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="me-3">Email :
                                    <b> {{ $customers->email }}</b>
                                </span>
                            </div>
                            <div class="mb-3">
                                <span class="me-3">Địa Chỉ :
                                    <b>
                                        {{ $customers->province->name }},
                                        {{ $customers->district->name }},
                                        {{ $customers->ward->name }},
                                    </b>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
