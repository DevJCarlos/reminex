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
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <label for="request"><strong class="text-success">Your Department's Student Requests</strong></label><br><br>
                            
                              <form method="#" action="#">
                                              @csrf
                                    <button type="button" class="collapsible">
                                        <div class="row">
                                            <div class="col-9"></div>
                                            <div class="col-3"><span class="badge bg-secondary"></span></div>
                                        </div>
                                    </button> 
                                    <div class="content2"><br>
                                        <label for="request"><strong>Request Type: &nbsp;</strong> </label><br>
                                        <label for="request"><strong>Subject to Take:  &nbsp;</strong> </label><br>
                                        <label for="request"><strong>Instructor:  &nbsp;</strong> </label><br>
                                        <label for="request"><strong>Reason:  &nbsp;</strong> </label><br>
                                        <label for="request"><strong>Time Availability:  &nbsp;</strong> </label><br>
                                        <label for="request"><strong>Requirements: &nbsp;</strong> </label>
                                          <button class="btn btn-warning">
                                                  <a href="#"> Download </a>
                                              </button>
                                          <br>

                                        <label for="request"><strong>Remarks:  &nbsp;</strong></label><label for="request"></label><br><br>
                                          
                                          <input type="submit" class="btn btn-success btn-lg" name="remarks" value="Approve">
                                          <input type="submit" class="btn btn-danger btn-lg" id="declineButton" value="Decline"><br><br>

                                            <div class="declineRemarks">
                                              <form action="#">
                                                <label for="reason"><strong>Decline Remarks:</strong></label>
                                                <textarea class="form-control" name="reason" rows="4" placeholder="Enter your remarks here"></textarea><br>
                                                <input type="submit" class="btn btn-warning btn-lg" id="declineButton2" value="Send Remarks">
                                              </form>
                                            </div><br>
                                            <input type="submit" class="btn btn-success btn-lg" id="approveButton" value="Approve"><br><br>

                                            <div id="approveReason" style="display: none;">
                                                <label for="reason"><strong>Approval Remarks:</strong></label>
                                                <textarea class="form-control" name="reason" rows="4" placeholder="Enter your remarks here"></textarea><br>
                                                <input type="submit" class="btn btn-warning btn-lg" id="approveButton2" value="Send Remarks"><br><br>
                                            </div>
                                            <!-- Decline button -->
                                            <input type="submit" class="btn btn-danger btn-lg" id="declineButton3" value="Decline"><br><br>


                                            <div id="declineReason" style="display: none;">
                                                <label for="reason"><strong>Decline Remarks:</strong></label>
                                                <textarea class="form-control" name="reason" rows="4" placeholder="Enter your remarks here"></textarea><br>
                                                <input type="submit" class="btn btn-warning btn-lg" id="declineButton4" value="Send Remarks">
                                            </div><br>
                                        
                                    </div><br>
                                </form>
                        </div>
                    </div>
                </div>
        </div>
	</div>
</div>

@endsection