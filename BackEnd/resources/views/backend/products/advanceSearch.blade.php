<div class="modal fade" id="searchModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm nâng cao</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <p><b>Tên sản phẩm:</b></p>
                                <input type="text" value="{{ request()->name }}" class="form-control" name="name"
                                    id="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <p><b>Giá:</b></p>
                                <input type="text" value="{{ request()->price }}" class="form-control" name="price"
                                    id="price" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <p><b>Số lượng:</b></p>
                                <input type="text" value="{{ request()->amount }}" class="form-control" name="amount"
                                    id="amount" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <p><b>Tên thương hiệu:</b></p>
                                <select name="" id="">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <p><b>Tên danh mục:</b></p>
                                <select name="" id="">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Trạng thái:</b></p>
                                <input type="radio" id="html"  name="status" value="0">
                                <label for="html">Ẩn </label><br>
                                <input type="radio" id="css"  name="status" value="1">
                                <label for="css">Hiện</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-dark ">Đặt lại</a>
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button> --}}
                    <button type="button" data-dismiss="modal" class="btn btn-secondary ml-auto"
                        id="clear-filter">Hủy</button>
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

    </div>
</div>
