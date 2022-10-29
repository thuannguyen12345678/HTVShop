@extends('backend.master')
@section('content')
<div class="page-inner">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href=""><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang danh
                    sách</a>
            </li>
        </ol>
    </nav>
    <header class="page-title-bar">
        <h1 class="page-title">Thêm chức vụ </h1>
    </header>
    <div class="page-section">
        <div class="card-deck-xl">
            <div class="card card-fluid">
                <div class="card-body">
                    <form action="{{route('groups.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="flatpickr01">Tên Nhân Viên</label>
                            <input id="flatpickr01" type="text" class="form-control" placeholder="vui lòng nhập"
                                value="{{ old('name') }}" name="name" data-toggle="flatpickr">
                        </div>
                        @if ($errors->any())
                            <p style="color:red">{{ $errors->first('name') }}</p>
                        @endif
                        <div class="form-group">
                            <label class="control-label" for="flatpickr01">Thông tin</label>
                            <input id="flatpickr01" type="text" class="form-control" placeholder="vui lòng nhập"
                                value="{{ old('description') }}" name="description" data-toggle="flatpickr">
                        </div>
                        @if ($errors->any())
                            <p style="color:red">{{ $errors->first('description') }}</p>
                        @endif
                        <div class="form-actions">
                            <a class="btn btn-secondary float-right" href="">Hủy</a>
                            <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
