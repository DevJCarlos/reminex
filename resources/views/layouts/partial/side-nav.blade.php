<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('student.index') }}">
            <span class="align-middle">
                <img src="{{asset('import/img/photos/loginlogo2.png')}}" alt="Company Name" width="200"></span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item {{ request()->routeIs('student.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('student.show') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.show') }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Exam Schedule</span>
                </a>
            </li>
            <li class="sidebar-header">
                Request
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.createrequest') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.createrequest') }}">
                    <i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Create Request</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.viewrequest') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.viewrequest') }}">
                    <i class="align-middle" data-feather="eye"></i> <span class="align-middle">View Requests</span>
                </a>
            </li>
            
            <li class="sidebar-header">
                Upshots
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.newsched') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.newsched') }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Your New Schedule</span>
                </a> 
            </li>

        </ul>
    </div>
</nav>