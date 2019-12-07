<!-- Page Sidebar -->
<div class="page-sidebar">

    <!-- Site header  -->
    <header class="site-header">
        <div class="site-logo">
            <a href="#">
                <img src="{{asset('assets/images/logo.png')}}" width="190">
            </a>
        </div>
        <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
        <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
    </header>
    <!-- /site header -->

    <!-- Main navigation -->
    <ul id="side-nav" class="main-menu navbar-collapse collapse">

        <li>
            <a href="#">
                <i class="icon-gauge"></i><span class="title">Dashboard</span>
            </a>
        </li>
        @if (auth('admin')->check())
            @if (auth('admin')->user()->type == 1)
            <li class="has-sub {{Route::is('programs.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Programs</span></a>
                <ul class="nav collapse">
{{--                    <li class="{{Route::is('programs.create') ? 'active' : ''}}"><a href="{{route('programs.create')}}"><span class="title">Add New</span></a></li>--}}
                    <li class="{{Route::is('programs.index') ? 'active' : ''}}"><a href="{{route('programs.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            <li class="has-sub {{Route::is('users.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Call centers</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('callcenters.create') ? 'active' : ''}}"><a href="{{route('callcenters.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('callcenters.index') ? 'active' : ''}}"><a href="{{route('callcenters.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            <li class="{{Route::is('adverse-reporting.index') ? 'active' : ''}}">
                <a href="{{route('adverse-reporting.index')}}">
                    <i class="icon-doc-text-inv"></i><span class="title">Adverse event reporting</span>
                </a>
            </li>
            @elseif(auth('admin')->user()->type == 2)
                <li>
                    <a href="{{route('novartis.programs')}}">
                        <i class="icon-doc-text-inv"></i><span class="title">Programs</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{route('novartis.programs')}}">
                        <i class="icon-doc-text-inv"></i><span class="title">Programs</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('marketing.index')}}">
                        <i class="icon-chart-pie"></i><span class="title">Statistics</span>
                    </a>
                </li>
            @endif
        @endif
        @if (auth('callcenter')->check())
            <li class="has-sub {{Route::is('doctors.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Doctors</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('doctors.create') ? 'active' : ''}}"><a href="{{route('doctors.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('doctors.index') ? 'active' : ''}}"><a href="{{route('doctors.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            <li class="has-sub {{Route::is('patients.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Patients</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('patients.create') ? 'active' : ''}}"><a href="{{route('patients.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('patients.index') ? 'active' : ''}}"><a href="{{route('patients.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            @if (auth('callcenter')->user()->program_id == 1)
            <li class="has-sub {{Route::is('pharmacies.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Pharmacies</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('pharmacies.create') ? 'active' : ''}}"><a href="{{route('pharmacies.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('pharmacies.index') ? 'active' : ''}}"><a href="{{route('pharmacies.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            @endif
            @if (auth('callcenter')->user()->program_id == 2)
            <li class="has-sub {{Route::is('laboratories.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Laboratories</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('laboratories.create') ? 'active' : ''}}"><a href="{{route('laboratories.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('laboratories.index') ? 'active' : ''}}"><a href="{{route('laboratories.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            @endif
            @if (auth('callcenter')->user()->program_id == 3)
            <li class="has-sub {{Route::is('hospitals.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Hospital / Center</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('hospitals.create') ? 'active' : ''}}"><a href="{{route('hospitals.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('hospitals.index') ? 'active' : ''}}"><a href="{{route('hospitals.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            @endif
            @if (auth('callcenter')->user()->program_id == 4)
            <li class="has-sub {{Route::is('eyes.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Healthcare Center</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('eyes.create') ? 'active' : ''}}"><a href="{{route('eyes.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('eyes.index') ? 'active' : ''}}"><a href="{{route('eyes.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
            @endif
            <li class="has-sub {{Route::is('adverse-reporting.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Adverse Reporting</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('adverse-reporting.create') ? 'active' : ''}}"><a href="{{route('adverse-reporting.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('adverse-reporting.index') ? 'active' : ''}}"><a href="{{route('adverse-reporting.index')}}"><span class="title">Show All</span></a></li>
                </ul>
            </li>
        @endif

        @if (auth('web')->check())

            @if (auth('web')->user()->type == 2)
            <li class="has-sub {{Route::is('orders.*') ? 'active' : ''}}">
                <a href=""><i class="icon-layout"></i><span class="title">Orders</span></a>
                <ul class="nav collapse">
                    <li class="{{Route::is('orders.create') ? 'active' : ''}}"><a href="{{route('orders.create')}}"><span class="title">Add New</span></a></li>
                    <li class="{{Route::is('orders.index') ? 'active' : ''}}"><a href="{{route('orders.index')}}"><span class="title">Show All</span></a></li>
                    <li class="{{Route::is('orders.foc') ? 'active' : ''}}"><a href="{{route('orders.foc')}}"><span class="title">FOC</span></a></li>
                </ul>
            </li>
            @endif
            @if (auth('web')->user()->type == 3)
                <li class="has-sub {{Route::is('tests.*') ? 'active' : ''}}">
                    <a href=""><i class="icon-layout"></i><span class="title">Tests</span></a>
                    <ul class="nav collapse">
                        <li class="{{Route::is('tests.index') ? 'active' : ''}}"><a href="{{route('tests.index')}}"><span class="title">Show All</span></a></li>
                    </ul>
                </li>
            @endif
            @if (auth('web')->user()->type == 4)
                <li class="has-sub {{Route::is('doctor.patients.*') ? 'active' : ''}}">
                    <a href=""><i class="icon-layout"></i><span class="title">Patients</span></a>
                    <ul class="nav collapse">
                        <li class="{{Route::is('doctor.patients.index') ? 'active' : ''}}"><a href="{{route('doctor.patients.index')}}"><span class="title">Show All</span></a></li>
                    </ul>
                </li>
            @endif
            @if (auth('web')->user()->type == 5)
                <li class="has-sub">
                    <a href=""><i class="icon-layout"></i><span class="title">Examinations</span></a>
                    <ul class="nav collapse">
                        <li class="{{Route::is('examinations.index') ? 'active' : ''}}"><a href="{{route('examinations.index')}}"><span class="title">Show All</span></a></li>
                    </ul>
                </li>
            @endif
            @if (auth('web')->user()->type == 6)
                <li class="has-sub">
                    <a href=""><i class="icon-layout"></i><span class="title">Vouchers</span></a>
                    <ul class="nav collapse">
                        <li class="{{Route::is('vouchers.search') ? 'active' : ''}}"><a href="{{route('vouchers.search')}}"><span class="title">Show All</span></a></li>
                    </ul>
                </li>
            @endif

        @endif

        <li>
        @if (auth('admin')->check())
            <a href="{{route('admin.logout')}}"><i class="icon-logout"></i>Logout</a>
        @elseif(auth('callcenter')->check())
            <a href="{{route('callcenter.logout')}}"><i class="icon-logout"></i>Logout</a>
        @else
            <a href="{{route('user.logout')}}"><i class="icon-logout"></i>Logout</a>
        @endif
        </li>
    </ul>
    <!-- /main navigation -->
</div>
<!-- /page sidebar -->
