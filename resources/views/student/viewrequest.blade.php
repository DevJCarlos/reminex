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
								<div class="table-responsive">
								  <table
									id="zero_config"
									class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Request Type</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Requirements</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
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
                                                <a href="{{ route('request.download', ['filePaths' => urlencode($requestrecord3->file_path)]) }}" class="btn btn-outline-warning">Download</a>
                                                </td>
                                                @if($requestrecord3->status === "Approved")
                                                <td class="badge badge-outline-success">{{ $requestrecord3->status }}
                                                <td class="text-success"><em>{{ $requestrecord3->remarks }}</em></td>   
                                                @endif
                                                @if($requestrecord3->status === "Rejected")
                                                <td class="badge badge-outline-danger">{{ $requestrecord3->status }}
                                                <td class="text-danger"><em>{{ $requestrecord3->remarks }}</em></td>   
                                                @endif
                                                @if($requestrecord3->status === "New Schedule Created")
                                                <td class="badge badge-warning">{{ $requestrecord3->status }}</td> 
                                                <td class="text-success"><em>Completed!</em></td> 
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

<script src="{{asset('import/js/app.js')}}"></script>

</body>
@endsection