<div class="mb-3">
    <div class="border-bottom">
        <div class="">
            <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
                <div class="container">
                    <a class="navbar-brand text-danger fw-bold" href="/">Motorbike Shop</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('product.overview')}}">Danh Sách Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/abouus">Về chúng tôi</a>
                            </li>
                        
                        </ul>
                        <form action="{{route('product.searchProduct')}}" method="POST" class="d-flex" role="search">
                            @csrf
                            <input class="form-control me-2" type="search" name="nameProduct" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div class="ms-3">
                            @if (session()->has('user'))
                            <a href="/auth/logout/" class="btn btn-danger p-2 ms-2">Đăng xuất</a>
                            
                            @else 
                            {{-- <a href="/auth/register/" class="btn btn-outline-secondary p-2 ms-2 disabled" disable>Đăng ký</a> --}}
                            <a href="/auth/login/" class="btn btn-primary  p-2 ms-2">Đăng nhập</a>
                            
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>    
</div>