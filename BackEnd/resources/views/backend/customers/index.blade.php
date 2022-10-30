@extends('backend.master')
@section('content')
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href=""><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
                    </li>
                </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">Danh sách khách hàng</h1>
                <div class="btn-toolbar">
                   
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
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('customers.index') }}">Tất Cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('customer.trash') }}">Thùng Rác</a>
                        </li>
                    </ul>
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
                                    <th> Tên khách hàng </th>
                                    <th> Số điện thoại </th>
                                    <th> Thao tác </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="align-middle"> {{ $customer->id }} </td>
                                        <td class="align-middle"> {{ $customer->name }}</td>
                                        <td class="align-middle"> {{ $customer->phone }} </td>
                                        <td>
                                            <form action="{{ route('customers.destroy', $customer->id) }}"
                                                style="display:inline" method="post">
                                                @can('view', App\Models\Customer::class)
                                                <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @endcan
                                                @can('forceDelete', App\Models\Customer::class)
                                                <button onclick="return confirm('Xóa khách hàng {{ $customer->name }} ?')"
                                                    type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                @endcan
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
