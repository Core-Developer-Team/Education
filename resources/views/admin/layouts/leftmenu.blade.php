<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.request.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Requests</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.event.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Event</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.resources.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Resource</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.announcement')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Announcement</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.proposals.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Proposal</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.courses.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Courses</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tutorials.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Tutorial</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.book.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Books</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.badge.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>User Badges</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>