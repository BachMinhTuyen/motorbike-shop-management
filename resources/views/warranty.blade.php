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
                <a href="{{route('order.orderAll')}}" class="list-group-item list-group-item-action">Quản lý hóa đơn</a>
                <a href="{{route('warranty.warrantyAll')}}" class="list-group-item list-group-item-action active" aria-current="true">Quản lý bảo hành</a>
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action">Quản lý khách hàng</a>
                <a href="{{route('user.userAll')}}" class="list-group-item list-group-item-action">Quản lý nhân viên</a>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="m-3">
            <div class="mb-3">
                <table class="table text-center align-middle table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">ID đơn hàng</th>
                            <th scope="col">ID xe</th>
                            <th scope="col">Tên xe</th>
                            <th scope="col">Bắt đầu</th>
                            <th scope="col">Kết thúc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{$item->order_id}}</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->start_date}}</td>
                            <td>{{$item->end_date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection