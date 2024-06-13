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
                <a href="#" class="list-group-item list-group-item-action">Quản lý bảo hành</a>
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action">Quản lý khách hàng</a>
                <a href="{{route('user.userAll')}}" class="list-group-item list-group-item-action">Quản lý nhân viên</a>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="mb-3">
            <h2 class="text-dart mb-3 mt-3">Tạo hóa đơn</h2>
            <form class="row g-3" action="{{route('order.addOrder')}}" method="POST">
                @csrf
                <input type="text" name="orderId" id="" value="{{$orderId}}">
                {{-- @if ($orderId == null) --}}
                <div class="col-md-6">
                    <label for="customerPhoneNumberInput" class="form-label">Số Điện Thoại KH</label>
                    <input type="text" class="form-control" id="customerPhoneNumberInput" name="customerPhoneNumber" value="{{ $customerPhoneNumber }}" required>
                </div>
                <div class="col-md-6">
                    <label for="usernameInput" class="form-label">Tên Nhân Viên</label>
                    <input type="text" class="form-control" id="usernameInput" name="username" value="{{$fullName}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="voucherInput" class="form-label">Voucher</label>
                    <input type="text" class="form-control" id="voucherInput" name="voucher" placeholder="Nhập voucher nếu có">
                </div>
                <div class="col-md-6">
                    <label for="amountInput" class="form-label">Tổng tiền</label>
                    <input type="text" class="form-control" id="amountInput" name="amount" value="{{$amount}}" readonly>
                </div>
                <div class="mb-3 mt-3">
                    <fieldset class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Phương thức thanh toán</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethodRadio" id="gridRadios1" value="Tiền mặt" checked>
                                <label class="form-check-label" for="gridRadios1">
                                Tiền mặt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethodRadio" id="gridRadios2" value="Chuyển khoản">
                                <label class="form-check-label" for="gridRadios2">
                                Chuyển khoản
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <hr>
                {{-- @else --}}
                <h3>Thông tin đơn hàng</h3>
                <p>Mã đơn hàng: {{ $orderId }}</p>
                <p>SĐT khách hàng: {{ $customerPhoneNumber }}</p>
                <p>Phương thức thanh toán: {{ $paymentMethod }}</p>

                {{-- @endif --}}

                
                <div class="col-md-3">
                    <input type="text" class="form-control" id="productIdInput" name="productId" placeholder="Nhập mã sản phẩm">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="quantityInput" name="quantity" placeholder="Nhập số lượng">
                </div>
                <div class="col-md-6">
                    @if ($orderId)
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    @else                    
                    <button type="submit" class="btn btn-primary">Tạo hóa đơn và thêm sản phẩm</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@if ($orderId)
<div class="mt-3 mb-5">
    <h2 class="text-primary text-center">Chi Tiết Hóa Đơn</h2>
    <table class="table table-striped text-center align-middle">
        <thead>
            <tr class="table-dark">
                <th scope="col">ID </th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Giá Tiền</th>
                <th scope="col">Số Lượng</th>
                <th scope="col">Thành Tiền</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $item)
            <tr>
                <td>{{ $item->car_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection