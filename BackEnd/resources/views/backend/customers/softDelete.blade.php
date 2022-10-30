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
            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">Danh sách khách hàng đã xóa</h1>
                <div class="btn-toolbar">
                    {{-- @can('create', App\Models\customer::class) --}}
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#searchModal">Tìm
                            nâng cao</button>
                        @include('backend.customers.advanceSearch')
                    </div>
                    <div class="md-5 title_cate d-flex">
                        <div class="form-outline">
                            <form action="">
                                <input type="search" value="" name="key" id="form1" class="form-control"
                                    placeholder="Tìm kiếm.." />
                        </div>
                        <button type="submit" class="btn btn-primary  waves-effect waves-light ">
                            <i class="fas fa-search"></i>
                        </button>
                        </form>
                    </div>
                    {{-- @endcan --}}
                </div>
            </div>
        </header>
        <div class="page-section">
            <div class="card card-fluid">
                <div class="card-header">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('customers.index') }}">Tất Cả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('customer.trash') }}">Thùng Rác</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="" method="GET" id="form-search">
                                <div class="input-group input-group-alt">
                                    {{-- @include('backend.customers.modals.modalFilterColumns') --}}
                            </form>
                        </div>
                    </div><br>
                    {{-- @if (!count($customers))
                        <p class="text-danger">
                        <div class="alert alert-danger"> <i class="bi bi-x-circle"></i> Không tìm thấy kết quả
                            {{ Session::get('error') }}</div>
                        </p>
                    @endif  --}}
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Tên khách hàng </th>
                                    <th> Số điện thoại </th>
                                    <th> Thao tác </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="align-middle"> {{ $customer->id }} </td>
                                        <td class="align-middle">
                                            {{ $customer->name }}
                                        </td>
                                        <td class="align-middle"> {{ $customer->phone }} </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-2">
                                                    @can('restore', App\Models\User::class)
                                                    <form action="{{ route('customer.restore', $customer->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary"
                                                            onclick="return confirm('Bạn muốn khôi phục khách hàng {{ $customer->name }}?')">
                                                            <i class="bi bi-arrow-counterclockwise"> </i></button>
                                                    </form>
                                                   @endcan
                                                </div>
                                                <div class="col-2">
                                                    @can('delete', App\Models\User::class)
                                                    <form action="{{ route('customer.forceDelete', $customer->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng {{ $customer->name }}?')"><i
                                                                class="bi bi-trash3"></i></button>
                                                    </form>
                                                   @endcan

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
