@extends('layout')

@section('content')
<body style="background-color: #22C7A9;">

<div class="grid-container">
    <div class="sidebar p-2" style="background-color: #D7EFE5;">
        <a href="{{route('admin.dashboardPage')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <img src="{{asset('storage/assets/admin.png')}}" alt="">
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{route('admin.dashboardPage')}}" class="nav-link" aria-current="page">
                    Home
                </a>
            </li>
            <li>
                <a href="{{route('guest.handleLogout')}}" class="nav-link">
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="inner-content" style="margin-left: 280px;">
        @yield('inner-content')
    </div>
</div>

</body>
@endsection
