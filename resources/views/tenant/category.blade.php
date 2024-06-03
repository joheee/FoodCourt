@extends('components.navigation_tenant')

@section('inner-content')

<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="container-fluid dynamic-container">
            <div class="card p-3 mb-3 shadow-sm">
                <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">Title</div>
                <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">Date</div>
            </div>
            <div class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>
    </div>
</div>
@endsection
