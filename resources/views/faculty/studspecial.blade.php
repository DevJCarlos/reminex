@extends('layouts.guest2')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

			    <h1 class="h3 mb-3"><strong>Student Special Exams</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
							  <div class="card-body text-danger">
								<div class="table-responsive">
								  <table id="userTable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Student Name</th>
                                            <th>Request Type</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                            <tbody>
                                            @foreach($requestrecords21 as $requestrecord21)
                                            @if ($requestrecord21->instructor === auth()->user()->name)
                                            @if($requestrecord21->request_type === "Special Exam Request")
                                            <tr>
                                                <td>{{ $requestrecord21->created_at }}</td>
                                                <td>{{ $requestrecord21->stud_name }}</td>
                                                <td>{{ $requestrecord21->request_type }}</td>
                                                <td>{{ $requestrecord21->subject }}</td>
                                                <td>{{ $requestrecord21->instructor }}</td>
                                                @if($requestrecord21->status === null)
                                                <td><h5 class="badge badge-warning">Pending</h5></td>
                                                @endif
                                                @if($requestrecord21->status === "Approved")
                                                <td><h5 class="badge badge-success">{{ $requestrecord21->status }}</h5></td>
                                                @endif
                                                @if($requestrecord21->status === "Completed")
                                                <td><h5 class="badge badge-success">{{ $requestrecord21->status }}</h5></td>
                                                @endif
                                                <td>
                                                  <a href="{{ route('finish_request', $requestrecord21->id) }}">
                                                    <input type="submit" class="btn btn-outline-success" onclick="return confirm('Special exam request will be completed. Proceed?')" value="Finish">
                                                  </a>
                                                </td>
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

<link href="{{ asset('import/css/tooltip2.css') }}" rel="stylesheet">
<script src="{{asset('import/js/app.js')}}"></script>

</body>
@endsection