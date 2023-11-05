<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('faculty.index') }}">
			 <span class="align-middle">
                <img src="{{asset('import/img/photos/loginlogo3.png')}}" alt="Company Name" width="200"></span>
        </a>

        <ul class="sidebar-nav">
			<li class="sidebar-header">Pages</li>
				<li class="sidebar-item {{ request()->routeIs('faculty.index') ? 'active' : '' }}">
					<a class="sidebar-link" href="{{ route('faculty.index') }}">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
					</a>
				</li>


				<li class="sidebar-item">
						<a class="sidebar-link" href="#">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Proctor Subject</span>
						</a>
				</li>

			<li class="sidebar-header">Request</li>
				<li class="sidebar-item {{ request()->routeIs('faculty.managerequest') ? 'active' : '' }}">
					<a class="sidebar-link" href="{{ route('faculty.managerequest') }}">
						<i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Manage New Schedule</span>
					</a>
				</li>

		</ul>
    </div>
</nav>