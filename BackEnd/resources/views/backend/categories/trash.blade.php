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
                <h1 class="page-title mr-sm-auto">Danh mục sản phẩm</h1>
                <div class="btn-toolbar">
                    <div class="input-group-prepend">
                        <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#searchModal">Tìm
                            nâng cao</button>
                        @include('backend.categories.advanceSearch')
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
                            <a class="nav-link " href="{{ route('categories.index') }}">Tất Cả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('categories.trash') }}">Thùng Rác</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
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
                    @if (!count($categories))
                        <p class="text-danger">
                        <div class="alert alert-danger"> <i class="bi bi-x-circle"></i> Không tìm thấy kết quả
                            {{ Session::get('error') }}</div>
                        </p>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Tên danh mục </th>
                                    <th> Trạng thái </th>
                                    <th> Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td class="align-middle"> {{ $key + 1   }} </td>

                                        <td class="align-middle"> {{ $category->name }} </td>
                                        <td>
                                            @if ($category->status == 1)
                                                <a href="{{ route('categories.hideStatus', $category->id) }}">
                                                    <i class="bi bi-eye-fill h3" style="color:rgb(71, 66, 233) "></i>

                                                </a>
                                            @else
                                                <a href="{{ route('categories.showStatus', $category->id) }}">
                                                    <i class="bi bi-eye-slash-fill h3" style="color:red"></i>
                                                </a>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-2">
                                                        @can('restore', App\Models\category::class)
                                                        <form action="{{ route('categories.restore', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-secondary"
                                                                onclick="return confirm('Bạn muốn khôi phục?')">
                                                                <i class="bi bi-arrow-counterclockwise"> </i></button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                    <div class="col-2">
                                                        @can('delete', App\Models\category::class)
                                                        <form
                                                            action="{{ route('categories.force_destroy', $category->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-icon btn-secondary"
                                                                onclick="return confirm('Bạn chắc chắn muốn xóa?')"><i
                                                                    class="bi bi-trash3"></i></button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float:right">

                            {{ $categories->onEachSide(5)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
