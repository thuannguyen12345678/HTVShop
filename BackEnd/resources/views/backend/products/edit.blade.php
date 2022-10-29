@extends('backend.master')
@section('content')
    <div class="page-inner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="{{ route('products.index') }}"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Trang danh
                        sách</a>
                </li>
            </ol>
        </nav>
        <header class="page-title-bar">
            <h1 class="page-title">Sửa Sản phẩm </h1>
        </header>
        <div class="page-section "  >
            <div class="card-deck-xl">
                <div class="card card-fluid">
                    <div class="card-body">
                        <form action="{{ route('products.update', $products->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row" >
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label" for="flatpickr01">Tên Sản phẩm</label> <input
                                            id="flatpickr01" type="text" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') ?? $products->name }}" name="name" data-toggle="flatpickr">
                                    </div>
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label" for="flatpickr01">Số lượng</label> <input
                                            id="flatpickr01" type="text" class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('amount') ?? $products->amount }}" name="amount" data-toggle="flatpickr">
                                    </div>
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('amount') }}</p>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="control-label" for="flatpickr01">Gía</label> <input id="flatpickr01"
                                            type="text" class="form-control @error('amount') is-invalid @enderror" value="{{ old('name') ??  $products->price }}"
                                            name="price" data-toggle="flatpickr">
                                    </div>
                                    @if ($errors->any())
                                        <p style="color:red">*{{ $errors->first('price') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="flatpickr01">Mô tả</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="ckeditor1" rows="5" style="resize: none">{{ old('description') ?? $products->description }}</textarea>
                                </div>
                                @if ($errors->any())
                                    <p style="color:red">*{{ $errors->first('description') }}</p>
                                @endif
                                <div class="col-lg-12">
                                    <div class="mb-2">
                                        <p><b>Màu sắc:</b></p>
                                        <input <?=$products->color =="Đen" ? 'checked' : ''?> type="radio" id="html"  name="color" value="{{ old('color') ?? $products->color }}" style="color:black" >
                                        <label for="html">Đen </label><br>
                                        <input <?=$products->color =="Trắng" ? 'checked' : ''?> type="radio" id="css"  name="color" value="{{ old('color') ?? $products->color }}" style="color:white"  >
                                        <label  for="css">Trắng</label><br>
                                        <input <?=$products->color =="Vàng" ? 'checked' : ''?> type="radio" id="css"  name="color" value="{{ old('color') ?? $products->color }}" style="color:yellow"  >
                                        <label for="css">Vàng</label><br>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-select" aria-label="Default select example">
                                        <label class="control-label" for="flatpickr01">Danh mục</label>
                                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror " id="inputGroupSelect02">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('category_id') }}</p>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <div class="form-select" aria-label="Default select example">
                                        <label class="control-label" for="flatpickr01">Nhãn hiệu</label>
                                        <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" id="inputGroupSelect02">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->any())
                                        <p style="color:red">{{ $errors->first('brand_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="tf1">Hình ảnh<abbr name="Trường bắt buộc">*</abbr></label>
                                        
                                        <input class="form-control @error('category_id') is-invalid @enderror" accept="image/*" type='file' id="inputFile" name="image" /><br>
                                        <br>
                                        <img type="hidden" width="90px" height="90px" id="blah1"
                                            src="{{ asset($products->image) }}" alt="" />
                                        @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="file_name">Detailed photos</label>
                                    <div class="card_file_name">
                                        <div class="form-group form_input">
                                            <span class="inner">
                                                Drag & drop image here or
                                                <span class="select">Browse</span>
                                            </span>
                                            <input type="file" name="file_names[]" id="file_name" multiple value=""
                                                class="form-control files @error('file_name') is-invalid @enderror">
                                        </div>
                                        <div class="container_image">
    
                                            @if ($errors->any())
                                            <p style="color:red">{{ $errors->first('file_name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                               

                            </div>



                            {{-- <div class="form-group">
                                <label class="control-label" for="flatpickr01">Công Khai</label>
                                <select name="is_published" class="form-control " id="inputGroupSelect02">
                                    <option value="{{1}}">Có</option>
                                    <option value="{{2}}">Không</option>
                                </select>
                            </div>
                            @if ($errors->any())
                            <p style="color:red">{{ $errors->first('is_published') }}</p>
                            @endif --}}
                            <div class="form-actions">
                                <a class="btn btn-secondary float-right" href="{{ route('products.index') }}">Hủy</a>
                                <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
