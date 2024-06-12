@extends('components.navigation_tenant')

@section('inner-content')
<div class="d-flex justify-content-center mt-5">
    <div class="w-50">
        <div class="container-fluid dynamic-container">
            @foreach ($order as $o)
                <div class="card p-3 mb-3 shadow-sm d-grid gap-2">
                    <div class="card-title mb-2" style="font-size: 1.5rem; font-weight: bold;">Order from {{$o->users->name}}</div>
                    <div class="card-subtitle text-muted" style="font-size: 1rem; font-weight: normal;">
                        {{ \Carbon\Carbon::parse($o->created_at)->format('g:i \a\t d F Y') }}
                    </div>
                    <a href="{{route('tenant.handleConfirmOrder', ['id' => $o->id])}}" class="btn
                        {{ $o->order_status == 0 ? 'btn-danger' : ($o->order_status == 1 ? 'btn-primary' : '') }}
                    ">
                        {{ $o->order_status == 0 ? 'confirm order' : ($o->order_status == 1 ? 'confirmed' : 'unknown status') }}
                    </a href="">
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
