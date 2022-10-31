@extends('backend.master')
@section('content')
    <div class="page-inner">
        <header class="page-title-bar">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('products.index') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quản Lý
                            danh mục</a>
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">Thêm Sản phẩm</h1>
        </header>

        <div class="page-section">
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Thông tin cơ bản</legend>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tf1"><b>Tên Sản phẩm</b><abbr name="Trường bắt buộc">*</abbr></label>
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        placeholder="Nhập tên Sản phẩm">
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tf1"> <b>Số lượng</b><abbr name="Trường bắt buộc">*</abbr></label>
                                    <input name="amount" type="text"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ old('amount') }}" placeholder="Nhập  Số lượng">
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('amount') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tf1"><b>Giá</b><abbr name="Trường bắt buộc">*</abbr></label> <input
                                        name="price" type="text" style="resize: none"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="Nhập Gía">
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('price') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tf1"><b>Mô tả</b><abbr name="Trường bắt buộc">*</abbr></label>
                                <textarea name="description" class="form-control" value="{{ old('description') }}" id="ckeditor1" rows="4"
                                    style="resize: none"></textarea>
                                @if ($errors->any())
                                    <p style="color:red">*{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                        </div><br><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-2">

                                    <label for="tf1"><b>Màu sắc</b><abbr name="Trường bắt buộc">*</abbr></label><br>
                                    <input type="radio" id="html" name="color" value="Đen">
                                    <label for="html">Đen </label>&nbsp
                                    <input type="radio" id="css" name="color" value="Trắng">
                                    <label for="css">Trắng</label>&nbsp
                                    <input type="radio" id="css" name="color" value="Vàng">
                                    <label for="css">Vàng</label>&nbsp
                                    <input type="radio" id="css" name="color" value="xanh">
                                    <label for="css">xanh</label>&nbsp
                                    @error('color')
                                    <p style="color:red">*{{ $errors->first('color') }}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01"><b>Danh mục</b><abbr
                                        name="Trường bắt buộc">*</abbr></label>
                                <select name="category_id" id=""
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p style="color:red">*{{ $errors->first('category_id') }}</p>
                                @enderror
                            </div>


                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01"><b>Nhãn hiệu</b><abbr
                                        name="Trường bắt buộc">*</abbr></label>
                                <select name="brand_id" id=""
                                    class="form-control @error('brand_id') is-invalid @enderror">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p style="color:red">*{{ $errors->first('brand_id') }}</p>
                                @enderror
                            </div>
                        </div> <br><br>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label class="control-label @error('category_id') is-invalid @enderror"
                                    for="flatpickr01"><b>Hìnhh Ảnh*</b></label><br>
                                <input accept="image/*" type='file' id="inputFile" name="image" /><br>
                                <br>
                                <img type="hidden" width="200px" height="200px" id="blah" src="#"
                                    alt="" />
                                @if ($errors->any())
                                    <p style="color:red">*{{ $errors->first('image') }}</p>
                                @endif
                            </div>

                            <div class="form-group col-lg-8">
                                <label for="file_name"><b>Hình ảnh chi tiết*</b></label>
                                <div class="card_file_name">
                                    <div class="form-group form_input @error('file_names') border border-danger @enderror">
                                        <input type="file" name="file_names[]" id="file_name" multiple
                                        class="form-control files @error('file_name') is-invalid @enderror">
                                        <span class="inner">
                                            <span class="select" style="color:red">Ctrl + click để chọn nhiều ảnh</span>
                                        </span>
                                    </div>
                                    <div class="container_image">
                                        @error($errors->any())
                                            <p style="color:red">*{{ $errors->first('file_name') }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-actions">
                            <a class="btn btn-secondary float-right" href="{{ route('products.index') }}">Hủy</a>
                            <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.file').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                    console.log(e);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script src="{{ asset('assets/js/uploadFile.js') }}"></script>
@endsection
