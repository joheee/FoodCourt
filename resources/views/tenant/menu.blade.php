@extends('components.navigation_tenant')

@section('inner-content')
<div class="d-flex justify-content-center">
    <div class="w-50">
        <div class="container-fluid dynamic-container">
            <div class="card bg-image">
                <img src="{{asset('storage/assets/sushi.jpg')}}" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h5 class="card-title text-white">Card title</h5>
                    <p class="card-text text-white">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text text-white"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <a href="{{route('tenant.menuAddPage')}}" class="card p-3 mb-3 shadow-sm" style="display: flex; justify-content: center; align-items: center">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>

@endsection
