@extends('layouts.guest2')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

			    <h1 class="h3 mb-3"><strong class="text-success">New Schedules Created </strong>(Reschedules)</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
							  <div class="card-body text-danger">
								<div class="table-responsive">
								  <table
									id="zero_config"
									class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Student Name</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Exam Day</th>
                                            <th>Exam Time</th>
                                            <th>Room</th>
                                        </tr>
                                        </thead>

                                            <tbody>
                                        @foreach($newscheds as $newsched)
                                        @if ($newsched->instructor2 === auth()->user()->name)
                                            <tr>
                                                <td class="table-secondary">{{ $newsched->created_at }}</td>
                                                <td class="table-secondary">{{ $newsched->stud_name2 }}</td>
                                                <td class="table-primary">{{ $newsched->subject2 }}</td>
                                                <td class="table-primary">{{ $newsched->instructor2 }}</td>
                                                <td class="table-warning">{{ $newsched->exam_day }}</td>   
                                                <td class="table-warning">{{ $newsched->exam_time }} - {{ $newsched->exam_time2 }}</td>
                                                <td class="table-warning">{{ $newsched->room }}</td>
                                            </tr>
                                        @endif
                                        @endforeach 
                                            </tbody>                 
								  </table>
								</div>
							  </div>
							</div>
						</div>				
					</div>
			</div>
		</main>
	</div>

<script src="{{asset('import/js/app.js')}}"></script>
</body>
@endsection