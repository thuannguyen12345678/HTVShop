<div class="modal fade" id="searchModal" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tìm nâng cao</h5>
                </div>
                <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên khách hàng
                                </label>
                                <input type="text" value="{{ request()->name }}" class="form-control"
                                    name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Số điện thoại
                                </label>
                                <input type="text" value="{{ request()->phone }}" class="form-control"
                                    name="phone" id="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Địa chỉ
                                </label>
                                <input type="text" value="{{ request()->address }}" class="form-control"
                                    name="address" id="address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">Ngày Đặt Đơn
                                </label>
                                <input type="date" value="{{ request()->created_at }}" class="form-control"
                                    name="created_at" id="created_at">
                            </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('orders.index') }}" class="btn btn-dark ">Đặt lại</a>
                    <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
                </div>
            </div>
        </form>
    </div>
</div>
