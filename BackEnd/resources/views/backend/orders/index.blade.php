@extends('backend.master')
@section('content')
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
                    </li>
                </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">Danh sách người đặt hàng</h1>
                <div class="btn-toolbar">
                    <div class="input-group-prepend">
                            {{-- @include('backend.category.advanceSearch') --}}
                    </div>
                    <div class="md-5 title_cate d-flex">
                        <div class="form-outline">
                            <form action="">
                                <input type="search" value="{{ request()->search }}" name="search"
                                id="form1" class="form-control" placeholder="Tìm theo SDT" />
                                </div>
                                <button type="submit" class="btn btn-primary  waves-effect waves-light ">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="card card-fluid">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Tất Cả</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            {{-- @include('backend.category.modals.modalFilterColumns') --}}
                        </div>
                    </div><br>

                    @if (Session::has('success'))
                        <p class="text-success">
                        <div class="alert alert-success"><i class="fa fa-check" aria-hidden="true"></i>
                            {{ Session::get('success') }}</div>
                        </p>
                    @endif
                    @if (Session::has('error'))
                        <p class="text-danger">
                        <div class="alert alert-danger"> <i class="bi bi-x-circle"></i>
                            {{ Session::get('error') }}</div>
                        </p>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Khách hàng </th>
                                    <th> Số điện thoại </th>
                                    <th> Xem chi tiết </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td class="align-middle"> {{ $key + 1 }} </td>
                                        <td class="align-middle"> {{ $order->customer->name }} </td>
                                        <td class="align-middle"> {{ $order->phone }} </td>
                                        <td>
                                                {{-- @can('Show_order', 'Show_order') --}}
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection