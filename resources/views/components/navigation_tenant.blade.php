@extends('layout')

@section('content')
<body style="background-color: #22C7A9;">

    <div class="p-2 py-3">
        <div class="text-center font-weight-bold">Tenant</div>
        <div class="d-flex justify-content-center gap-5">
            <a class="navbar-button" href="{{route('tenant.allPage')}}">All</a>
            <a class="navbar-button" href="{{route('tenant.menuPage')}}">Menu</a>
            <a class="navbar-button" href="{{route('tenant.orderPage')}}">Order</a>
            <a class="navbar-button" href="{{route('tenant.transactionPage')}}">Transaction</a>
            <a class="navbar-button" href="{{route('tenant.categoryPage')}}">Category</a>
            <a class="navbar-button" href="{{route('guest.handleLogout')}}">Logout</a>
        </div>
    </div>

    @yield('inner-content')
</body>
@endsection
