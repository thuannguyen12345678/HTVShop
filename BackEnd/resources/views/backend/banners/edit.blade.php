@extends('backend.master')
@section('content')
<div class="page-inner">
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{route('banners.index')}}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quay Lại</a>
                </li>
            </ol>
        </nav>
        <div class="d-md-flex align-items-md-start">
            <h1 class="page-title mr-sm-auto">Sửa Ảnh Bìa </h1>
        </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="card-body">
                                <form action="{{ route('banners.update', $banner->id) }}" method="POST"
                                    enctype="multipart/form-data" class="form">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label for="path" class="form-label">Đường Link</label>
                                        <input name="path" value="{{ old('path') ?? $banner->url }}" type="input"
                                            class="form-control @error('path') is-invalid @enderror" id="path">
                                        <span class="text-danger">{{ $errors->first('path') }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner" class="form-label">Chọn Ảnh Bìa</label>
                                        <input name="banner" value="{{ old('banner') ?? $banner->image }}" type="file"
                                            class="form-control @error('banner') is-invalid @enderror" id="banner">
                                            <img type="hidden" width="90px" height="90px" id="blah1"
                                            src="{{ asset($banner->image) }}" alt="" />
                                        <span class="text-danger">{{ $errors->first('banner') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sửa</button>
                                    <a href="{{ route('banners.index') }}" class="btn btn-danger">Hủy</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
