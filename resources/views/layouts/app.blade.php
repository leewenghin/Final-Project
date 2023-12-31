<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'E-Complaint') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->

    <!-- Scripts -->
    <script src="{{ asset('dist/jquery/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('dist/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Rubik:wght@300&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/13427233db.js" crossorigin="anonymous"></script>

</head>

<body class="login_page_bng ">
    @if (Auth::check())
    <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container d-flex justify-content-between">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
            <!-- <a href="{{ route('home') }}" class="text-decoration-none justify-content-center">
                <h2 class="text-center m-0">e-Complaint</h2>
            </a> -->
            <div>
                <h4 class="m-auto">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h4>
                <div class="d-flex justify-content-between">
                    <div class="m-auto me-2">
                        <img src="{{ asset(Auth::user()->GetAvatar()) }}" alt="" width="40px" height="40px" class="rounded-circle">
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="">
                        @csrf
                        <button type="submit" class="btn btn-danger text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <div class="sidenav-scrollable">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <a href="{{ route('home') }}" class="text-decoration-none justify-content-center">
                <h2 class="text-center">e-Complaint</h2>
            </a>

            <div class="d-flex justify-content-center my-3">
                <img class="image_rounded" src="{{ asset(Auth::user()->GetAvatar()) }}" alt="profile.png" height="150px">
            </div>

            <div class="list-group-top">
                <h4 class="sidenav-profile text-center">Name: {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h4>

                @if (Auth::user()->HasRole())
                <div class="list-group hover_chg_text_clr">
                <!-- <a href="{{ route('home') }}" class="text-decoration-none justify-content-center">
                <img src="/images/support.png" alt="customer-support.png" height="30px">
                <span class="h5">Complainant</span>
                </a> -->
                    @if (Auth::user()->IsHelpDesk())
                    <a data-bs-toggle="collapse" href="#collapseHelpdesk" role="button" aria-expanded="false" aria-controls="collapseHelpdesk" class="list-group-item list-group-item-action h5 @if(Request::is('help-desk/*')) active @endif">
                        <img src="/images/support.png" alt="customer-support.png" height="30px">
                        <span>Help Desk</span>
                        <i class="fa-solid fa-chevron-right fa-2xs"></i>
                    </a>
                    <div id="collapseHelpdesk" class="collapse">
                        <a href="{{ route('helpdesk.dashboard') }}">Dashboard</a>
                        <a href="{{ route('helpdesk.complaints.index') }}">All Complaints</a>
                        <a href="{{ route('helpdesk.verified_complaints.index') }}">Ongoing Complaints</a>
                    </div>
                    @endif
                    @if (Auth::user()->IsExecutive())
                    <a href="{{ route('executive.dashboard') }}" class="list-group-item list-group-item-action h5 @if(Request::is('executive/*')) active @endif">
                        <img src="/images/complaint.png" alt="executive.png" height="30px">
                        <span>Executive</span></a>
                    @endif
                    @if (Auth::user()->IsAdmin())
                    <a data-bs-toggle="collapse" href="#collapseAdmin" role="button" aria-expanded="false" aria-controls="collapseAdmin" class="list-group-item list-group-item-action h5 justify-content-between @if(Request::is('administrator/*')) active @endif">
                        <img src="/images/administrator.png" alt="administrator.png" height="30px">
                        <span>Administrator</span>
                        <i class="fa-solid fa-chevron-right fa-2xs"></i>
                    </a>
                    <div id="collapseAdmin" class="collapse">
                        <a href="{{ route('users.index') }}">User Profile List</a>
                        <a href="{{ route('departments.index') }}">Department List</a>
                    </div>
                    @endif

                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <div id="main" class="py-4">
        @yield('content')
    </div>

    @if (Auth::check())
    <div>
        @include('layouts.footer')
    </div>
    @endif
</body>

</html>