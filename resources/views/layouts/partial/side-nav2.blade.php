<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('faculty.index') }}">
			 <span class="align-middle">
                <img src="{{asset('import/img/photos/logofaculty.png')}}" alt="Company Name" width="200"></span>
        </a>

        <ul class="sidebar-nav">
			<li class="sidebar-header">Pages</li>
				<li class="sidebar-item {{ request()->routeIs('faculty.index') ? 'active' : '' }}">
					<a class="sidebar-link" href="{{ route('faculty.index') }}">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
					</a>
				</li>

				<li class="sidebar-item {{ request()->routeIs('faculty.show') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('faculty.show') }}">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Proctor Subject</span>
						</a>
				</li>

			<li class="sidebar-header">Request</li>

			<li class="sidebar-item {{ request()->routeIs('faculty.managerequest') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('faculty.managerequest') }}">
					<i class="align-middle" data-feather="edit-3"></i>
					<span class="align-middle">Manage Reschedules</span>
					@php
						$currentUser = auth()->user();
						$approvedRequestsCount = \App\Models\RequestModel::where('instructor', $currentUser->name)
							->where('request_type', 'Reschedule Request')
							->whereIn('status', ['Approved'])
							->count();
					@endphp
					@if($approvedRequestsCount > 0)
						<span class="indicator bg-danger rounded-circle">{{ $approvedRequestsCount }}</span>
					@endif
				</a>
			</li>
				
				<li class="sidebar-item {{ request()->routeIs('faculty.studspecial') ? 'active' : '' }}">
					<a class="sidebar-link" href="{{ route('faculty.studspecial') }}">
						<i class="align-middle" data-feather="hard-drive"></i> <span class="align-middle">Student Special Exams</span>
					</a>
				</li>

			<li class="sidebar-header">History</li>

            <li class="sidebar-item {{ request()->routeIs('faculty.createdNewsched') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('faculty.createdNewsched') }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Created New Schedules</span>
                </a> 
            </li>

		</ul>
    </div>
</nav>