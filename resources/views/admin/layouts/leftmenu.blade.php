<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
        
        <div class="sidebar-brand-text mx-3">CRAVSOL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dep') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Department</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.request.index') }}">
            <i class="fas fa-fw fa-archive"></i>
            <span>Requests</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.event.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Event</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contest.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Contest</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.resources.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Resource</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.announcement') }}">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Announcement</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.proposals.index') }}">
            <i class="fas fa-fw fa-terminal"></i>
            <span>Proposal</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.courses.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Courses</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tutorials.index') }}">
            <i class="fas fa-book-reader"></i>
            <span>Tutorial</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.book.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Books</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notification') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notifications</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Products</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.badge.index') }}">
            <i class="fas fa-fw fa-award"></i>
            <span>User Badges</span></a>
    </li>
    @if (Auth::user()->role->name == 'Moderator')
        
    <li class="nav-item">
        <a class="nav-link" href="{{ route('moderator.index') }}">
            <i class="fas fa-fw fa-award"></i>
            <span>Moderator</span></a>
    </li>
    
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.payment-log') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Payment Logs</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.term')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Terms</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.privacy')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Privacy</span></a>
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
