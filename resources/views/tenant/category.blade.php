@extends('components.navigation_tenant')

@section('inner-content')

<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="container-fluid dynamic-container">
            @foreach ($category as $c)
                <div class="card p-3 shadow-sm">
                    <div class="card-title" style="font-size: 1.5rem; font-weight: bold;">{{$c->tenant_menu_category_name}}</div>
                </div>
            @endforeach
            <a href="{{route('tenant.categoryAddPage')}}" class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>
@endsection
