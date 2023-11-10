@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('REQUEST MANAGEMENT') }}</strong></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><strong class="text-success">{{auth()->user()->department}} Student Requests</strong></h5><br><br>
                        <div class="table-responsive">
                            <table id="dtBasicExample" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="th-sm">Date</th>
                                        <th class="th-sm">Name</th>
                                        <th class="th-sm">Request Type</th>
                                        <th class="th-sm">Subject</th>
                                        <th class="th-sm">Instructor</th>
                                        <th class="th-sm">Reason</th>
                                        <th class="th-sm">Time Availability</th>
                                        <th class="th-sm">Requirements</th></th>
                                        <th class="th-sm">Status</th>
                                        <th class="th-sm">Action</th>
                                        <th class="th-sm">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($requestrecords as $requestrecord)
                                @if($requestrecord->department === auth()->user()->department)
                                @if($requestrecord->status === null)

                                    <tr>
                                        <td>{{ $requestrecord->created_at }}</td>
                                        <td>{{ $requestrecord->stud_name }}</td>
                                        <td>{{ $requestrecord->request_type }}</td>
                                        <td>{{ $requestrecord->subject }}</td>
                                        <td>{{ $requestrecord->instructor }}</td>
                                        <td>
                                        <span class="tool" data-tip="{{ $requestrecord->reason }}" tabindex="1">Reason</span>
                                        </td>
                                        <td>{{ $requestrecord->time_avail1}} - {{ $requestrecord->time_avail2}}</td>
                                        <td>{{ $requestrecord->file_name }} 

                                        <a href="{{ route('request.download', ['filePaths' => urlencode($requestrecord->file_path)]) }}" class="btn btn-outline-secondary">Download</a>

                                        <td>
                                        @if($requestrecord->status === null)
                                        <h5 class="badge badge-warning">Pending</h5>
                                        @endif
                                        @if($requestrecord->status === "Approved")
                                        <h5 class="badge badge-outline-success">{{ $requestrecord->status }}</h5>
                                        @endif
                                        @if($requestrecord->status === "Rejected")
                                        <h5 class="badge badge-outline-danger">{{ $requestrecord->status }}</h5>
                                        @endif
                                        </td>
                                        <td>
                                        @if($requestrecord->request_type === "Reschedule Request")
                                            <a href="{{ route('approve_request', $requestrecord->id) }}">
                                                <input type="submit" class="btn btn-outline-success" onclick="return confirm('Are you sure to approve this request?')" value="Approve">
                                            </a>
                                        @endif
                                        @if($requestrecord->request_type === "Special Exam Request")
                                            <a href="{{ route('approve_request2', $requestrecord->id) }}">
                                                <input type="submit" class="btn btn-outline-success" onclick="return confirm('Are you sure to approve this request?')" value="Approve">
                                            </a>
                                        @endif

                                        </td>
                                        <td>
                                            <form action="{{ route('reject_request', $requestrecord->id) }}" method="post">
                                                @csrf
                                                <textarea class="form-control" rows="2" name="rejectreason" placeholder="Reason for rejecting requests..." required></textarea><br>
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure to reject this request?')">Reject</button>
                                            </form>
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
</div>
 
<!-- <script>
    $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
}); -->
</script>
<!-- MDBootstrap Datatables  -->
<link href="{{ asset('import/datatablecss/css/addons/datatables2.min.css') }}" rel="stylesheet">
<link href="{{ asset('import/css/tooltip.css') }}" rel="stylesheet">
<script>"{{ asset('import/datatablejs/js/addons/datatables2.min.js') }}"</script>
@endsection