@extends('layout')

@section('content')
<body style="background-color: #22C7A9;">


    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between px-2" style="width: 100vw;">
        <span class="navbar-brand text-center h1 fw-bold mb-0 logo">E - Foodcourt</span>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.allPage')}}">All</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.menuPage')}}">Menu</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.orderPage')}}">Order</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.transactionPage')}}">Transaction</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.categoryPage')}}">Category</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('tenant.categoryPage')}}">Profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('guest.handleLogout')}}">Logout</a>
                </li>
          </ul>
        </div>
      </nav>

    <div class="m-5">
        @yield('inner-content')
    </div>
</body>
@endsection
