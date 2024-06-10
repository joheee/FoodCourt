@extends('components.navigation_tenant')

@section('inner-content')
<div class="d-flex justify-content-center">
    <div class="w-50">
        <div class="d-flex justify-content-between">
            <div class="">List Menu</div>
            <a href="{{route('tenant.menuPage')}}">View All</a>
        </div>
        <div class="container-fluid dynamic-container">
            @foreach ($menu as $m)
                <a href="{{route('tenant.editMenuPage', ['id' => $m->id])}}" class="card bg-image">
                    <img src="{{ asset('storage/assets/menu/' . $m->tenant_menu_picture) }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title text-white">{{$m->tenant_menu_name}}</h5>
                        <p class="card-text text-white">{{$m->tenant_menu_description}}</p>
                        <p class="card-text text-white"><small class="">IDR {{$m->tenant_menu_price}}</small></p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="d-flex justify-content-between">
            <div class="">Recent Orders</div>
            <a href="">View All</a>
        </div>
        <div class="container-fluid dynamic-container">
            <div class="card p-3 shadow-sm">
                <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">Title</div>
                <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">Date</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="d-flex justify-content-between">
            <div class="">Recent Orders</div>
            <a href="">View All</a>
        </div>
        <div class="container-fluid dynamic-container">
            <div class="card p-3 shadow-sm">
                <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">Title</div>
                <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">Date</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="d-flex justify-content-between">
            <div class="">Categories</div>
            <a href="{{route('tenant.categoryPage')}}">View All</a>
        </div>
        <div class="container-fluid dynamic-container">
            @foreach ($category as $c)
            <div class="card p-3 shadow-sm">
                <div class="card-title" style="font-size: 1.5rem; font-weight: bold;">{{$c->tenant_menu_category_name}}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
