@extends('layout.base')

@section('title')
    Thêm Sản Phẩm
@endsection

@section('content')
<div class="row">
    <div class="col-3">
        <div class="m-3">
            <h2 class="text-dark text-center mb-3">Bảng điều khiển</h2>
            <div class="list-group">
                <a href="/" class="list-group-item list-group-item-action" >
                    Quản lý sản phẩm
                </a>
                <a href="#" class="list-group-item list-group-item-action">Quản lý mã khuyến mãi</a>
                <a href="{{route('order.orderAll')}}" class="list-group-item list-group-item-action active" aria-current="true">Quản lý hóa đơn</a>
                <a href="{{route('warranty.warrantyAll')}}" class="list-group-item list-group-item-action">Quản lý bảo hành</a>
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action">Quản lý khách hàng</a>
                <a href="{{route('user.userAll')}}" class="list-group-item list-group-item-action">Quản lý nhân viên</a>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="mb-3">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <h2 class="text-dart mb-3">Thêm Sản Phẩm</h2>
                    <form action="{{route('product.addProduct')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="productNameInput" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="productNameInput" name="name" required>
                            @error('product_name')
                            <div class="form-text text-danger"></div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="modelInput" class="form-label">Mẫu Xe - (Dòng Xe)</label>
                            <select class="form-select" aria-label="Default select example" id="modelInput" name='model'>
                                <option selected>Chọn mẫu xe - (dòng xe)</option>
                                <option value="Xe số">Xe số</option>
                                <option value="Xe tay ga">Xe tay ga</option>
                                <option value="Xe tay côn">Xe tay côn</option>
                                <option value="Xe điện">Xe điện</option>
                                <option value="Xe moto">Xe moto</option>
                                <option value="Xe địa hình">Xe địa hình</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="countryNameInput" class="form-label">Xuất Xứ</label>
                            <input type="text" class="form-control" id="countryNameInput" name="country" required>
                        </div>
                        <div class="mb-3">
                            <label for="yearInput" class="form-label">Năm Sản Xuất</label>
                            <input type="text" class="form-control" id="yearInput" name="year" required>
                        </div>
                        <div class="mb-3">
                            <label for="warrantyInput" class="form-label">Bảo Hành</label>
                            <select class="form-select" aria-label="Default select example" id="warrantyInput" name="warranty">
                                <option selected>Thời hạn bảo hành</option>
                                <option value="0.5">6 tháng</option>
                                <option value="1">1 năm</option>
                                <option value="2">2 năm</option>
                                <option value="3">3 năm</option>
                                <option value="5">5 năm</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="priceInput" class="form-label">Giá</label>
                            <input type="text" class="form-control" id="priceInput" name="price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>

@endsection