@extends('components.navigation_customer')

@section('inner-content')
<div class="w-50 d-grid justify-content-center">
    <div class="text-center fw-bold display-7 bg-white rounded-md" style="border-radius: 10px">Tenant List</div>
    <div class="container-fluid dynamic-container">
        @foreach ($tenant as $t)
            <a href="{{route('customer.tenantDetailPage', ['id'=>$t->id])}}" class="card bg-image">
                <img src="{{ asset('storage/assets/tenant/' . $t->tenant_picture) }}" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">{{$t->tenant_name}}</h5>
                    <p class="card-text text-white">{{$t->tenant_location}}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
