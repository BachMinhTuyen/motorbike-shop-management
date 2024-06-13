@extends('layout.base')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
<div class="mb-3">
    <div class="row">
        @foreach ($carList as $item)
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img width="100" height="220" src="{{asset('assets/img')}}/{{$item->img}}" class="card-img-top" alt="{{$item->img}}">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">
                        <ul>
                            <li>Xuất Xứ: {{$item->country}}</li>
                            <li>Năm SX: {{$item->year}}</li>
                            <li>Giá: {{$item->price}}</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection