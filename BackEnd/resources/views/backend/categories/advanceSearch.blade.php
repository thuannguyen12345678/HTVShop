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
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <p><b>Tên danh mục:</b></p>
                                <input type="text" value="{{ request()->name }}" class="form-control" name="name"
                                    id="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Trạng thái:</b></p>
                                <input type="radio" id="html" checked name="status" value="0">
                                <label for="html">Hide </label><br>
                                <input type="radio" id="css" checked name="status" value="1">
                                <label for="css">Show</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-dark ">Đặt lại</a>
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button> --}}
                    <button type="button" data-dismiss="modal" class="btn btn-secondary ml-auto"
                        id="clear-filter">Hủy</button>
                    <button type="submit" class="btn btn-primary">Tìm</button>
                </div>
            </div>
        </form>

    </div>
</div>
