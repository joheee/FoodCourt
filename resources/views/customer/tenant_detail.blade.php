@extends('components.navigation_customer')

@section('inner-content')
<div class="w-50 d-grid justify-content-center">
    <div class="text-center fw-bold display-7 bg-white rounded-md" style="border-radius: 10px">List Menu</div>
    <div class="container-fluid dynamic-container">
        @foreach ($menu as $m)
        <div class="card bg-image">
            <img src="{{ asset('storage/assets/menu/' . $m->tenant_menu_picture) }}" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title text-white">{{$m->tenant_menu_name}}</h5>
                <p class="card-text text-white">{{$m->tenant_menu_description}}</p>
                <p class="card-text text-white"><small class="">IDR {{$m->tenant_menu_price}}</small></p>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
