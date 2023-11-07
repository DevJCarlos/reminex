@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('REQUEST ARCHIVE') }}</strong></h1>
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
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($requestrecords5 as $requestrecord5)
                                @if($requestrecord5->department === auth()->user()->department)
                                @if($requestrecord5->status === "Approved" || $requestrecord5->status === "Approved" || $requestrecord5->status === "New Schedule Created")
                                    <tr>
                                        <td>{{ $requestrecord5->created_at }}</td>
                                        <td>{{ $requestrecord5->stud_name }}</td>
                                        <td>{{ $requestrecord5->request_type }}</td>
                                        <td>{{ $requestrecord5->subject }}</td>
                                        <td>{{ $requestrecord5->instructor }}</td>
                                        <td>{{ $requestrecord5->reason }}</td>
                                        <td>{{ $requestrecord5->time_available}}</td>
                                        <td>{{ $requestrecord5->file_name }} 

                                        <a href="{{ route('request.download', ['filePaths' => urlencode($requestrecord5->file_path)]) }}" class="btn btn-outline-secondary">Download</a>

                                        <td>
                                        @if($requestrecord5->status === "Approved")
                                        <h5 class="badge badge-success">{{ $requestrecord5->status }}</h5>
                                        @endif
                                        @if($requestrecord5->status === "Rejected")
                                        <h5 class="badge badge-danger">{{ $requestrecord5->status }}</h5>
                                        @endif
                                        @if($requestrecord5->status === "New Schedule Created")
                                        <h5 class="badge badge-warning">{{ $requestrecord5->status }}</h5>
                                        @endif
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
<script>"{{ asset('import/datatablejs/js/addons/datatables2.min.js') }}"</script>
@endsection