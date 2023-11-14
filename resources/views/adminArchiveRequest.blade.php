@extends('layouts.app')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('REQUEST HISTORY') }}</strong></h1>
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
                        <table id="example1" class="table table-bordered table-striped">
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
                            <th class="th-sm">Remarks</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($requestrecords5 as $requestrecord5)
                            @if($requestrecord5->department === auth()->user()->department)
                            @if($requestrecord5->status === "Approved" || $requestrecord5->status === "Rejected" || $requestrecord5->status === "New Schedule Created" || $requestrecord5->status === "Completed")
                                    <tr>
                                        <td>{{ $requestrecord5->created_at }}</td>
                                        <td>{{ $requestrecord5->stud_name }}</td>
                                        <td>{{ $requestrecord5->request_type }}</td>
                                        <td>{{ $requestrecord5->subject }}</td>
                                        <td>{{ $requestrecord5->instructor }}</td>
                                        <td class="text-warning">
                                            <span class="tool" data-tip="{{ $requestrecord5->reason }}" tabindex="1">Reason</span>
                                        </td>
                                        <td>{{ $requestrecord5->time_avail1}} - {{ $requestrecord5->time_avail2}}</td>
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
                                        @if($requestrecord5->status === "Completed")
                                            <h5 class="badge badge-warning">{{ $requestrecord5->status }}</h5>
                                        @endif
                                        </td>
                                        <td>
                                        @if($requestrecord5->status === "Approved")
                                            <span class="tool text-warning" data-tip="{{ $requestrecord5->remarks }}" tabindex="1">Remarks</span>
                                        @endif
                                        @if($requestrecord5->status === "Rejected")
                                            <span class="tool text-warning" data-tip="{{ $requestrecord5->remarks }}" tabindex="1">Remarks</span>   
                                        @endif
                                        @if($requestrecord5->status === "New Schedule Created")
                                            <span class="tool text-warning" data-tip="Completed!" tabindex="1">Remarks</span>
                                        @endif
                                        @if($requestrecord5->status === "Completed")
                                            <span class="tool text-warning" data-tip="Completed!" tabindex="1">Remarks</span>
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
<link href="{{ asset('import/css/tooltip.css') }}" rel="stylesheet">
<script>"{{ asset('import/datatablejs/js/addons/datatables2.min.js') }}"</script>
@endsection