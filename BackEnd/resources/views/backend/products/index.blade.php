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
                <h1 class="page-title mr-sm-auto">Danh sách sản phẩm</h1>
                <div class="btn-toolbar">


                    {{-- @can('create', App\Models\product::class) --}}


                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#searchModal">Tìm
                            nâng cao</button>
                        @include('backend.products.advanceSearch')
                    </div>

                    <div class="md-5 title_cate d-flex">
                        <div class="form-outline">
                            <form action="">
                                <input type="search" value="" name="key" id="form1" class="form-control"
                                    placeholder="search..." />

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
                            <a class="nav-link active" href="">Tất Cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('products.trash') }}">Thùng Rác</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col">
                            <form action="" method="GET" id="form-search">

                                <div class="input-group input-group-alt">
                                    @can('create', App\Models\Product::class)
                                        <a href="{{ route('products.create') }}" class="btn btn-primary mr-2">
                                            <i class="fa-solid fa fa-plus"></i>
                                            <span class="ml-1">Thêm Mới</span>
                                        </a>
                                    @endcan
                                    <a style="float: right" href="{{ route('export-products') }}" class="btn btn-primary">
                                        <i class="fas fa-file"></i>
                                        <span class="ml-1">Xuất file excel</span>
                                    </a>
                                </div>

                                    {{-- @include('backend.products.modals.modalFilterColumns') --}}
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
                    @if (!count($products))
                        <p class="text-danger">
                        <div class="alert alert-danger"> <i class="bi bi-x-circle"></i> Không tìm thấy kết quả
                            {{ Session::get('error') }}</div>
                        </p>
                    @endif
                    <div class="table-responsive">
                        <table class="table" style="text-align: center">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Ảnh </th>
                                    <th> Tên Sản phẩm </th>
                                    <th> Số lượng </th>
                                    <th> Giá </th>
                                    <th> Trạng thái</th>
                                    <th> Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="align-middle"> {{ $key + 1 }} </td>
                                        <td>
                                            <img style="width:100px; height:70px" src="{{ asset($product->image) }}">
                                        </td>
                                        <td class="align-middle"> {{ $product->name }} </td>
                                        <td class="align-middle"> {{ $product->amount }} </td>
                                        <td class="align-middle"> {{ $product->price }} </td>
                                        <td>
                                            @if ($product->status == 1)
                                                <a href="{{ route('products.hideStatus', $product->id) }}">
                                                    <i class="bi bi-eye-fill h3" style="color:rgb(71, 66, 233) "></i>
                                                </a>
                                            @else
                                                <a href="{{ route('products.showStatus', $product->id) }}">
                                                    <i class="bi bi-eye-slash-fill h3" style="color:red"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                style="display:inline" method="post">
                                                @can('view', App\Models\product::class)
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                        class="btn btn-sm btn-icon btn-secondary"><i class="bi bi-eye"></i></a>
                                                @endcan
                                                @can('update', App\Models\product::class)
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-icon btn-secondary"><i
                                                            class="fa fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('forceDelete', App\Models\product::class)
                                                    <button onclick="return confirm('Xóa {{ $product->name }} ?')"
                                                        type="submit" class="btn btn-sm btn-icon btn-secondary"><i
                                                            class="far fa-trash-alt"></i></button>
                                                @endcan
                                                @csrf
                                                @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="float:right">
                    {{ $products->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
