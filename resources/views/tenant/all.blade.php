@extends('components.navigation_tenant')

@section('inner-content')
<div class="d-flex justify-content-center">
    <div class="w-50">
        <div class="d-flex justify-content-between">
            <div class="">List Menu</div>
            <a href="">View All</a>
        </div>
        <div class="container-fluid dynamic-container">
            <div class="card bg-image">
                <img src="{{asset('storage/assets/sushi.jpg')}}" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">Card title</h5>
                    <p class="card-text text-white">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text text-white"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
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
            <div class="card p-3 mb-3 shadow-sm">
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
            <div class="card p-3 mb-3 shadow-sm">
                <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">Title</div>
                <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">Date</div>
            </div>
        </div>
    </div>
</div>
@endsection
