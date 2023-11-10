@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

			    <h1 class="h3 mb-3"><strong class="text-success">Your New Schedule</strong></h1>

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
                                            <th>Request Type</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Exam Day</th>
                                            <th>Exam Time</th>
                                            <th>Room</th>
                                        </tr>
                                        </thead>

                                            <tbody>
                                        @foreach($requestrecords4 as $requestrecord4)
                                        @if ($requestrecord4->stud_name2 === auth()->user()->name)
                                            <tr>
                                                <td class="table-secondary">{{ $requestrecord4->request_type2 }}</td>
                                                <td class="table-warning">{{ $requestrecord4->subject2 }}</td>
                                                <td class="table-warning">{{ $requestrecord4->instructor2 }}</td>
                                                <td class="table-danger">{{ $requestrecord4->exam_day }}</td>   
                                                <td class="table-danger">{{ $requestrecord4->exam_time }} - {{ $requestrecord4->exam_time2 }}</td>
                                                <td class="table-danger">{{ $requestrecord4->room }}</td>
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