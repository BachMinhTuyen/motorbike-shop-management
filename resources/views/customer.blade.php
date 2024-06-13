@extends('layout.base')

@section('title')
    Danh sách khách hàng
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
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action active" aria-current="true">Quản lý khách hàng</a>
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
                            <th scope="col">ID Khách Hàng</th>
                            <th scope="col">Tên Khách Hàng</th>
                            <th scope="col">Ngày Sinh</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Địa Chỉ</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customerList as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->fullName}}</td>
                            <td>{{$item->dateOfBirth}}</td>
                            <td>{{$item->phoneNumber}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->email}}</td>
                            <td class="d-flex justify-content-evenly">
                                <a href="/customer/profile/{{$item->id}}" type="button" class="btn btn-primary detailLink">Chi Tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Show Detail Modal -->
<div class="modal fade" id="showDetailModal" tabindex="-1" aria-labelledby="showDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showDetailModalLabel">Hồ sơ người dùng</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('customer.updateProfile')}}" method="POST">
                    @csrf
                    <input type="text" name="id" id="customerIdInput" hidden>
                    <div class="mb-3">
                        <label for="customerNameInput" class="form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" id="customerNameInput" name="fullName">
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
            </div>
            <div class="modal-footer">
                    {{-- <a href="#" id="detailLink" type="button" class="btn btn-danger">Cập nhật</a> --}}
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    var detailLinks = document.querySelectorAll('.detailLink');
    detailLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            var href = this.getAttribute('href');
            var id = href.split('/').pop();

            fetch('/customer/profile/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('customerIdInput').value = id;
                    document.getElementById('customerNameInput').value = data.fullName;
                    document.getElementById('dateOfBirthInput').value = data.dateOfBirth;
                    document.getElementById('phoneNumberInput').value = data.phoneNumber;
                    document.getElementById('addressInput').value = data.address;

                    // Hiển thị modal sau khi dữ liệu được tải thành công
                    $('#showDetailModal').modal('show');
                    $("#showDetailModal").on("shown.bs.modal", () => {
                        $("#detailLink").attr("href", href);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle the error here
                });
        });
    });
</script>
@endsection