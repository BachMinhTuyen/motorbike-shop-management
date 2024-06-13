@extends('layout.base')

@section('title')
    Chi tiết đơn hàng
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
        <div class="m-3">
            <div class="mb-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border border-0">Mã đơn hàng: <span class="text-dark fw-bold">{{$order->id}}</span></li>
                    <li class="list-group-item border border-0">Tên Khách Hàng: <span class="text-dark fw-bold">{{$order->fullName}}</span></li>
                    <li class="list-group-item border border-0">Số điện thoại: <span class="text-dark fw-bold">{{$order->phoneNumber}}</span></li>
                    <li class="list-group-item border border-0">Phương thức thanh toán: <span class="text-dark fw-bold">{{$order->payment_method}}</span></li>
                    <li class="list-group-item border border-0">Tổng tiền: <span class="text-dark fw-bold">{{$order->amount}}</span></li>
                    <li class="list-group-item border border-0">Trạng thái: <span class="text-dark fw-bold">{{$order->status}}</span></li>
                </ul>
            </div>
            @if ($order->status == 'Chờ thanh toán')
            <div class="mb-3">
                <a href="/order/confirm/{{$order->id}}" class="btn btn-primary">Xác nhận đơn hàng</a>
                <a href="/order/cancel/{{$order->id}}" class="btn btn-danger">Hủy đơn hàng</a>
            </div>
            @endif
            <div class="mb-3">
                <table class="table text-center align-middle table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">ID xe</th>
                            <th scope="col">Tên xe</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $item)
                        <tr>
                            <td>{{$item->car_id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->total}}</td>
                            <td class="d-flex justify-content-evenly">
                                <a href="/order/detailDelete/{{$item->id}}" type="button" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection