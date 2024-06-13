@extends('layout.base')

@section('title')
    Trang chủ
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
            <a href="{{route('order.addOrder')}}" type="button" class="btn btn-primary mb-3">Tạo hóa đơn</a>
            <div class="mb-3">
                <table class="table text-center align-middle table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderList as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->fullName}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->amount}}</td>
                            <td class="d-flex justify-content-evenly">
                                <a href="/order/detail/{{$item->id}}" type="button" class="btn btn-primary">Chi Tiết</a>
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