@extends('backend.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <div class="md-3">
                                        <h2 for="example-text-input" class="form-label">Thêm Ảnh Bìa</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data"
                                    class="form">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="path" class="form-label">Đường Link</label>
                                        <input name="path" value="{{ old('path') }}" type="input"
                                            class="form-control @error('path') is-invalid @enderror" id="path">
                                        <span class="text-danger">{{ $errors->first('path') }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="banner" class="form-label">Chọn Ảnh Bìa</label>
                                        <input name="banner" value="{{ old('banner') }}" type="file"
                                            class="form-control @error('banner') is-invalid @enderror" id="banner">
                                        <span class="text-danger">{{ $errors->first('banner') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
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
