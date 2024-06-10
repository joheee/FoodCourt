@extends('components.navigation_admin')

@section('inner-content')
<div class="w-50 d-grid justify-content-center">
    <div class="text-center fw-bold display-6">Tenant List</div>
    <div class="container-fluid dynamic-container">
        @foreach ($tenant as $t)
            <a href="{{route('admin.editTenantPage', ['id' => $t->id])}}" class="card bg-image">
                <img src="{{ asset('storage/assets/tenant/' . $t->tenant_picture) }}" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">{{$t->tenant_name}}</h5>
                    <p class="card-text text-white">{{$t->tenant_location}}</p>
                </div>
            </a>
        @endforeach
        <a href="{{route('admin.tenantRegisterPage')}}" class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</div>
@endsection
