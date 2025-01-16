<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                @if (Auth::user()->role == 'admin')
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{route('admin.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Manage User
                </a>
                @else
                <a class="nav-link {{ request()->routeIs('auth.dashboard') ? 'active' : '' }}"
                    href="{{route('auth.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @endif

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>