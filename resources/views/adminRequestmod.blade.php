@extends('layouts.app')
@section('content')

<div class="main">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card">
                        <div class="card-body">
                            <label for="request"><strong class="text-success">Your Student Requests</strong></label><br><br>
                                    <form action="#" method="#">
                                        <button type="button" class="collapsible">
                                            <div class="row">
                                                <div class="col-9"></div>
                                                <div class="col-3"><span class="badge bg-secondary"></span></div>
                                            </div>
                                        </button> 
                                        <div class="content2"><br>
                                            <label for="request"><strong>Request Type: &nbsp;</strong></label><label for="request"></label><br>
                                            <label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"></label><br>
                                            <label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"></label><br>
                                            <label for="request"><strong>Reason:  &nbsp;</strong></label><label for="request"></label><br>
                                            <label for="request"><strong>Time Availability:  &nbsp;</strong></label><label for="request"></label><br>
                                            <label for="request"><strong>Exam Permit: &nbsp;</strong></label>
                                                <a href="#">
                                                    Download Exam Permit
                                                </a><br>

                                            <label for="request"><strong>Requirements: &nbsp;</strong></label>
                                                <a href="#">
                                                    Download Requirements
                                                </a><br>
                                            <label for="request"><strong>Remarks:  &nbsp;</strong></label><label for="request"></label><br><br>
                                            <input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Create New Schedule">
                                            <input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Approve">
                                            <input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Decline and Send Remark"><br><br>
                                        
                                          </div>
                                </form>
                            @endforeach
                      </div>
                  </div>
			 </div>
        </div>
	</div>

@endsection