@extends('components.navigation_customer')

@section('inner-content')
<div class="w-50 d-grid justify-content-center">
    <div class="text-center fw-bold display-7 bg-white rounded-md" style="border-radius: 10px">Customer's Cart</div>
    <div class="container-fluid dynamic-container">
        @foreach ($menu->cartItems as $c)
        <div class="card bg-image">
            <img src="{{ asset('storage/assets/menu/' . $c->tenantMenus->tenant_menu_picture) }}" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h5 class="card-title text-white">{{$c->tenantMenus->tenant_menu_name}}</h5>
                <p class="card-text text-white">{{$c->tenantMenus->tenant_menu_description}}</p>
                <p class="card-text text-white"><small class="">IDR {{$c->tenantMenus->tenant_menu_price}}</small></p>
                <div class="d-flex align-items-center gap-2">
                    <a onClick="alert('success remove from to cart!')" href="{{ route('customer.handleAddToCart', ['id' => $c->tenantMenus->id, 'isUpdate' => 2]) }}" class="btn btn-secondary btn-sm">-</a>
                    <span class="text-white">{{$c->quantity}}</span>
                    <a onClick="alert('success add to cart!')" href="{{ route('customer.handleAddToCart', ['id' => $c->tenantMenus->id, 'isUpdate' => 1]) }}" class="btn btn-secondary btn-sm">+</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
