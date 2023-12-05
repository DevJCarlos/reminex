<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>
            <!--<li class="sidebar-item {{ request()->routeIs('student.index') ? 'active' : '' }}">-->
            <!--    <a class="sidebar-link" href="{{ route('student.index') }}">-->
            <!--        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>Admins</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.indexfaculty') }}" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>Faculties</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.indexstudent') }}" class="nav-link">
                            <i class="nav-icon far fa-address-card"></i>
                            <p>Students</p>
                        </a>
                    </li>
                   
                </ul>
            </li>

            <!--<li class="nav-item">-->
            <!--    <a href="{{ route('users.index') }}" class="nav-link">-->
            <!--        <i class="nav-icon fas fa-users"></i>-->
            <!--        <p>-->
            <!--            {{ __('Users') }}-->
            <!--        </p>-->
            <!--    </a>-->
            <!--</li>-->

            <!-- <li class="nav-item">
                <a href="{{ route('exams.room') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                       Rooms
                    </p>
                </a>
            </li> -->
            
            @if (auth()->user()->position === "Academic Head")
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-regular fa-calendar"></i>
                    <p>
                        Exams
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('exams.index') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-calendar-days"></i>
                            <p>All Exams</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('exam.create') }}" class="nav-link">
                            <i class="nav-icon fa-regular fa-calendar-plus"></i>
                            <p>Create Exam</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if (auth()->user()->department != "Academic Head")
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-exclamation"></i>
                    <p>
                        Requests
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('requests') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-file-import"></i>
                            <p>Pending Requests</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminArchiveRequest') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                            <p>Requests History</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if (auth()->user()->department === "Academic Head")
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-sliders"></i>
                    <p>
                        Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="{{ route('exams.room') }}" class="nav-link">
                            <i class="nav-icon fa-solid fa-door-open"></i>
                            <p>Rooms</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                       <a href="{{ route('requestSubjects.reSbjects') }}" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Subjects</p>
                       </a>
                    </li>  -->
                </ul>
            </li>
            @endif
            
            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-circle-info"></i>
                    <p>
                        {{ __('About us') }}
                    </p>
                </a>
            </li>


            <!-- <li class="nav-item">
                <a href="{{ route('requests') }}" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Requests') }}
                    </p>
                </a>
            </li> -->

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon far fa-user"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->