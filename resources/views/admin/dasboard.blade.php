@extends('components.navigation_admin')

@section('inner-content')
<div class="w-50 d-grid justify-content-center">
    <div class="text-center fw-bold display-6">Tenant List</div>
    <div class="container-fluid dynamic-container">
        @foreach ($tenant as $t)
            <div class="card p-3 mb-3 shadow-sm">
                <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">{{$t->tenant_name}} | {{$t->email}}</div>
                <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">{{$t->tenant_location}}</div>
            </div>
        @endforeach
        <a href="{{route('admin.tenantRegisterPage')}}" class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>
</div>
@endsection
