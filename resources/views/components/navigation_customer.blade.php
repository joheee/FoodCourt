@extends('layout')

@section('content')
<body class="d-flex flex-column align-items-center gap-5" style="background-color: #22C7A9;">

    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between px-2" style="width: 100vw;">
        <span class="navbar-brand text-center h1 fw-bold mb-0 logo">E - Foodcourt</span>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('customer.landingPage')}}">Tenant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer.customerCartPage')}}">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tenant.allPage')}}">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('guest.handleLogout')}}">Logout</a>
                </li>
          </ul>
        </div>
      </nav>

    @yield('inner-content')
</body>
@endsection
