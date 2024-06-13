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
                <a href="{{route('order.orderAll')}}" class="list-group-item list-group-item-action">Quản lý hóa đơn</a>
                <a href="{{route('warranty.warrantyAll')}}" class="list-group-item list-group-item-action">Quản lý bảo hành</a>
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action">Quản lý khách hàng</a>
                <a href="{{route('user.userAll')}}" class="list-group-item list-group-item-action active" aria-current="true">Quản lý nhân viên</a>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="mb-3">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <h2 class="text-dart mb-3">Thêm Nhân Viên</h2>
                    <form action="{{route('user.addUser')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="usernameInput" class="form-label">Username</label>
                            <input type="text" class="form-control" id="usernameInput" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwordInput" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordInput" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullNameInput" class="form-label">Tên Nhân Viên</label>
                            <input type="text" class="form-control" id="fullNameInput" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="dateOfBirthInput" class="form-label">Ngày Sinh</label>
                            <input type="date" class="form-control" id="dateOfBirthInput" name="dateOfBirth">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumberInput" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phoneNumberInput" name="phoneNumber">
                        </div>
                        <div class="mb-3">
                            <label for="addressInput" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="addressInput" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="emailInput" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailInput" name="email">
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