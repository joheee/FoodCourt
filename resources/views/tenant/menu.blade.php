@extends('components.navigation_tenant')

@section('inner-content')
<div class="d-flex justify-content-center">
    <div class="w-50">
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
            <a href="{{route('tenant.menuAddPage')}}" class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>

@endsection
