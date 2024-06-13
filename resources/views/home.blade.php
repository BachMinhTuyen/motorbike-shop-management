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
                <a href="/" class="list-group-item list-group-item-action active" aria-current="true "">
                    Quản lý sản phẩm
                </a>
                <a href="#" class="list-group-item list-group-item-action">Quản lý mã khuyến mãi</a>
                <a href="{{route('order.orderAll')}}" class="list-group-item list-group-item-action">Quản lý hóa đơn</a>
                <a href="{{route('warranty.warrantyAll')}}" class="list-group-item list-group-item-action">Quản lý bảo hành</a>
                <a href="{{route('customer.customerAll')}}" class="list-group-item list-group-item-action">Quản lý khách hàng</a>
                <a href="{{route('user.userAll')}}" class="list-group-item list-group-item-action">Quản lý nhân viên</a>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="m-3">
            <a href="{{route('product.addProduct')}}" type="button" class="btn btn-primary mb-3">Thêm sản phẩm</a>
            <div class="mb-3">
                <table class="table text-center align-middle table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col">ID</th>
                            <th scope="col">Tên xe</th>
                            <th scope="col">Mẫu xe</th>
                            <th scope="col">Xuất xứ</th>
                            <th scope="col">Năm SX</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carList as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                <span>{{$item->name}}</span>
                                <span class="ms-1 me-1 badge text-bg-warning"> Bảo hành {{$item->warranty_period * 12}} tháng</span>
                            </td>
                            <td>{{$item->model}}</td>
                            <td>{{$item->country}}</td>
                            <td>{{$item->year}}</td>
                            {{-- <td>{{ format_currency($item->price)}}</td> --}}
                            {{-- <td>{{$item->price}}</td> --}}
                            <td class="d-flex justify-content-evenly">
                                <a href="/product/detail/{{$item->id}}" type="button" class="btn btn-primary detailLink">Chi Tiết</a>
                                <a href="/product/delete/{{$item->id}}" type="button" class="btn btn-danger deleteLink">Xóa</a>
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
                <h1 class="modal-title fs-5" id="showDetailModalLabel">Chi Tiết Sản Phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('product.updateProduct')}}" method="POST">
                    @csrf
                    <input type="text" name="id" id="productIdInput" hidden>
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
                    {{-- <button type="submit" class="btn btn-primary">Thêm</button> --}}
                {{-- </form> --}}
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

<!-- Delete Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="notificationModalLabel">Cảnh báo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn <span class="text-danger">xóa</span> thông tin xe này
            </div>
            <div class="modal-footer">
                <a href="#" id="deleteLink" type="button" class="btn btn-danger">Xóa</a>
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
            console.log(href);
            var id = href.split('/').pop();
            console.log(id)

            fetch('/product/detail/' + id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('productIdInput').value = id;
                    document.getElementById('productNameInput').value = data.name;
                    document.getElementById('modelInput').value = data.model;
                    document.getElementById('countryNameInput').value = data.country;
                    document.getElementById('yearInput').value = data.year;
                    document.getElementById('warrantyInput').value = data.warranty_period;
                    console.log(data.price)
                    document.getElementById('priceInput').value = data.price;

                    // Hiển thị modal
                    $('#showDetailModal').modal('show');
                    $("#showDetailModal").on("shown.bs.modal", () => {
                        $("#detailLink").attr("href", href);
                    });
                });
            
            $('#showDetailModal').modal('show');
            $("#showDetailModal").on("shown.bs.modal", () => {
                    $("#detailLink").attr("href", href);
                    console.log($("#detailLink"));
                });
        })
    })
</script>
<script>
    var deleteLinks = document.querySelectorAll(".deleteLink");

    deleteLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            var href = this.getAttribute("href");
            console.log(href);
            if (href !== "#") {
                // Mở modal download
                $("#notificationModal").modal("show");
                //Xử lý link trong model
                $("#notificationModal").on("shown.bs.modal", () => {
                    $("#deleteLink").attr("href", href);
                    console.log($("#deleteLink"));
                });
            }
        });
    });
</script>
@endsection