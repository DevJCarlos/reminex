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
								  <table id="zero_config" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="table-dark">Date</th>
												<th class="table-dark">Request Type</th>
												<th class="table-dark">Subject</th>
												<th class="table-dark">Instructor</th>
												<th class="table-dark">Exam Day</th>
												<th class="table-dark">Exam Time</th>
												<th class="table-dark">Room</th>
											</tr>
										</thead>      
										<tbody>
										@foreach ($requestrecords4 as $requestrecord4)
										@if ($requestrecord4->stud_name2 === auth()->user()->name)

											@php
												// Calculate the difference in minutes between now and the creation time
												$createdTime = \Carbon\Carbon::parse($requestrecord4->created_at);
												$currentDateTime = \Carbon\Carbon::now();
												$minutesDifference = $currentDateTime->diffInMinutes($createdTime);
											@endphp

											@if ($minutesDifference <= 48 * 60)
											<tr>
												<td class="table-secondary">{{$requestrecord4->created_at}}</td>
												<td class="table-secondary">{{$requestrecord4->request_type2}}</td>
												<td class="table-warning">{{$requestrecord4->subject2}}</td>
												<td class="table-warning">{{$requestrecord4->instructor2}}</td>
												<td class="table-danger">{{$requestrecord4->exam_day}}</td>
												<td class="table-danger">{{$requestrecord4->exam_time}}</td>
												<td class="table-danger">{{$requestrecord4->room}}</td>
											</tr>
											@endif
											
										@endif
											
										@endforeach
										</tbody>    
								  </table>
								</div>
							  </div>
							</div>
						</div>				
					</div><br><br>

          		<h1 class="h3 mb-3"><strong class="text-secondary">Old Reschedules</strong></h1>

				  <div class="row">
						<div class="col-12">
							<div class="card">
							  <div class="card-body text-danger">
							  	<div class="table-responsive" style="overflow-y: scroll; max-height: 500px;">
								  <table id="userTable" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Date</th>
												<th>Request Type</th>
												<th>Subject</th>
												<th>Instructor</th>
												<th>Exam Day</th>
												<th>Exam Time</th>
												<th>Room</th>
											</tr>
										</thead>      
										<tbody>
										@foreach ($requestrecords4 as $requestrecord4)
										@if ($requestrecord4->stud_name2 === auth()->user()->name)

											@php
												// Calculate the difference in minutes between now and the creation time
												$createdTime = \Carbon\Carbon::parse($requestrecord4->created_at);
												$currentDateTime = \Carbon\Carbon::now();
												$minutesDifference = $currentDateTime->diffInMinutes($createdTime);
											@endphp

											@if ($minutesDifference >= 48 * 60)
											<tr>
												<td class="table-secondary">{{$requestrecord4->created_at}}</td>
												<td class="table-secondary">{{$requestrecord4->request_type2}}</td>
												<td class="table-secondary">{{$requestrecord4->subject2}}</td>
												<td class="table-secondary">{{$requestrecord4->instructor2}}</td>
												<td class="table-secondary">{{$requestrecord4->exam_day}}</td>
												<td class="table-secondary">{{$requestrecord4->exam_time}}</td>
												<td class="table-secondary">{{$requestrecord4->room}}</td>
											</tr>
											@endif
											
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