@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

			    <h1 class="h3 mb-3"><strong>Your Requests</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
							  <div class="card-body text-danger">
								<div class="table-responsive" style="overflow-y: scroll; max-height: 2000px;">
								  <table id="userTable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Request Type</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Requirements</th>
                                            <th class="table-dark">Status</th>
                                            <th class="table-dark">Remarks</th>
                                        </tr>
                                        </thead>

                                            <tbody>
                                            @foreach($requestrecords3 as $requestrecord3)
                                            @if ($requestrecord3->stud_name === auth()->user()->name)
                                            <tr>
                                                <td>{{ $requestrecord3->created_at }}</td>
                                                <td>{{ $requestrecord3->request_type }}</td>
                                                <td>{{ $requestrecord3->subject }}</td>
                                                <td>{{ $requestrecord3->instructor }}</td>   
                                                <td>{{ $requestrecord3->file_name }}
                                                <a href="{{ route('request.download2', ['filePaths' => urlencode($requestrecord3->file_path)]) }}" class="btn btn-outline-warning">Download</a>
                                                </td>
                                                @if($requestrecord3->status === null)
                                                <td class="table-secondary"><h5 class="badge badge-warning text-dark">Pending</h5></td>
                                                @endif
                                                @if($requestrecord3->status === "Approved")
                                                @if($requestrecord3->request_type === "Reschedule Request")
                                                <td class="table-secondary"><h5 class="badge badge-success">{{ $requestrecord3->status }}</h5></td>
                                                <td class="table-secondary text-success" style="font-family: 'Prestige Elite Std';">{{ $requestrecord3->remarks }}</td>
                                                @endif
                                                @if($requestrecord3->request_type === "Special Exam Request")
                                                <td class="table-secondary"><h5 class="badge badge-success">{{ $requestrecord3->status }}</h5></td>
                                                <td class="table-secondary  text-light" style="font-family: 'Prestige Elite Std';">
                                                  <div class="con-tooltip left">
                                                    {{ $requestrecord3->remarks }}
                                                    <div class="tooltip ">
                                                      Reminder: Only 85% of the exam score will be recorded in Special Exam.
                                                    </div>
                                                  </div>
                                                </td>
                                                @endif
                                                @endif
                                                @if($requestrecord3->status === "Completed")
                                                @if($requestrecord3->request_type === "Special Exam Request")
                                                <td class="table-secondary"><h5 class="badge badge-warning">{{ $requestrecord3->status }}</h5></td>
                                                <td class="table-secondary text-success" style="font-family: 'Prestige Elite Std';">Completed!</td>
                                                @endif
                                                @endif
                                                @if($requestrecord3->status === "Rejected")
                                                <td class="table-secondary"><h5 class="badge badge-danger ">{{ $requestrecord3->status }}</h5></td>
                                                <td class="table-secondary text-danger" style="font-family: 'Prestige Elite Std';">{{ $requestrecord3->remarks }}</td>   
                                                @endif
                                                @if($requestrecord3->status === "New Schedule Created")
                                                <td class="table-secondary"><h5 class="badge badge-warning text-dark">{{ $requestrecord3->status }}</h5></td>
                                                <td class="table-secondary text-success" style="font-family: 'Prestige Elite Std';">Completed!<br><br>
                                                <a href="{{ route('student.newsched') }}" class="btn btn-outline-success">View Schedule</a>
                                                </td> 
                                                @endif
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

<link href="{{ asset('import/css/tooltip2.css') }}" rel="stylesheet">
<script src="{{asset('import/js/app.js')}}"></script>

</body>
@endsection