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
                                        <a data-href="{{ route('banner.updateStatus', $banner->id) }}" class="updateStatus"
                                                data-status="{{ $banner->status }}"  id="{{ $banner->id }}">
                                            <i class="h4  iconStatus{{ $banner->id }}
                                                {{ $banner->status ? 'bi bi-eye-fill h3' : 'bi bi-eye-slash-fill h3' }} "></i>
                                        </a>
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
                    {{ $banners->onEachSide(5)->links() }}
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
    <script>
        $(document).on('click', '.updateStatus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let status = $(this).data('status');
            let href = $(this).data('href') + `/` + status;
            let csrf = '{{ csrf_token() }}';
            console.log(href);
            Swal.fire({
                title: 'Bạn có chắc?',
                text: "Thay đổi trạng thái của sản phẩm!",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'    
            }).then((result) => {
                if (status) {
                    $(this).data('status', 0);
                    $(`.iconStatus${id}`).removeClass('bi bi-eye-fill h3');
                    $(`.iconStatus${id}`).addClass('bi bi-eye-slash-fill h3');
                } else {
                    $(this).data('status', 1);
                    $(`.iconStatus${id}`).removeClass('bi bi-eye-slash-fill h3');
                    $(`.iconStatus${id}`).addClass('bi bi-eye-fill h3');
                }
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            console.log(id);
                            Swal.fire(
                                'Cập nhật thành công!','','success'
                            )
                        }
                    });
                }
            })
        });
    </script>
@endsection
