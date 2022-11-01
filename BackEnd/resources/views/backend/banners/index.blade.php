@extends('backend.master')
@section('content')
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('dashboard') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang Chủ</a>
                    </li>
                </ol>
            </nav>
            <div class="d-md-flex align-items-md-start">
                <h1 class="page-title mr-sm-auto">Ảnh Bìa </h1>
            </div>

    </div>

    </header>
    <div class="page-section">
        <div class="card card-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="" method="GET" id="form-search">
                            <div class="input-group input-group-alt">
                                <a href="{{ route('banners.create') }}" class="btn btn-primary mr-2">
                                    <i class="fa-solid fa fa-plus"></i>
                                    <span class="ml-1">Thêm Mới</span>
                                </a>
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
                    <table class="table" style=" text-align: center">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Ảnh Bìa </th>
                                <th> Trạng Thái </th>
                                <th> Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $banner)
                                <tr>
                                    <td class="align-middle"> {{ $key + 1}} </td>
                                    <td>
                                        <img style="width:300px; height:100px" src="{{ asset($banner->image) }}">
                                    </td>
                                    <td>
                                        @if ($banner->status == 1)
                                            <a href="{{ route('banner.hideStatus', $banner->id) }}">
                                                <i class="bi bi-eye-fill h3" style="color:rgb(71, 66, 233) "></i>
                                            </a>
                                        @else
                                            <a href="{{ route('banner.showStatus', $banner->id) }}">
                                                <i class="bi bi-eye-slash-fill h3" style="color:red"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('banners.destroy', $banner->id) }}" style="display:inline"
                                            method="post">
                                            {{-- @can('update', App\Models\banner::class) --}}
                                            <a href="{{ route('banners.edit', $banner->id) }}"
                                                class="btn btn-sm btn-icon btn-secondary"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                            {{-- @endcan --}}
                                            {{-- @can('forceDelete', App\Models\banner::class) --}}
                                            <button onclick="return confirm('Xóa {{ $banner->name }} ?')" type="submit"
                                                class="btn btn-sm btn-icon btn-secondary"><i
                                                    class="far fa-trash-alt"></i></button>
                                            {{-- @endcan --}}
                                            @csrf
                                            @method('Delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div style="float:right">
                    {{-- {{ $banners->onEachSide(5)->links() }} --}}
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
