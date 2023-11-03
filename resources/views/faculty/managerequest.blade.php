@extends('layouts.guest2')

@section('content')
	<div class="main">
			<main class="content">
					<div class="container-fluid p-0">

						<h1 class="h3 mb-3">Manage<strong> New Schedule</strong></h1>

						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-body">					
										<label for="request"><strong class="text-success">Your Student Requests </strong></label><br><br>
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
										<form action="#" method="#">
												<button type="button" class="collapsible">
													<div class="row">
														<div class="col-9">Basan, Gian Rogel Y. </div>
														<div class="col-3"><span class="badge bg-secondary">10/10/23 10:00 AM</span></div>
													</div>
												</button>
													<div class="content2"><br>
														<label for="request"><strong>Request Type: &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Time Availability:  &nbsp;</strong></label><label for="request"> </label><br><br>
														<input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Create New Schedule"><br><br>
													</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-body">
										<form action="#" method="#">
											<label for="request"><h1 class="h3 d-inline align-middle"><strong class="text-success">NEW SCHEDULE</strong></h1></label><br><br>
														<label for="request"><strong>Name: &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> </label><br>
														<label for="request"><strong>Exam Day Schedule:  &nbsp;</strong></label>
														<input type="date" class="calendar"><br>
														<label for="request"><strong>Exam Time Schedule:  &nbsp;</strong></label><br>
														<input type="text" class="form-control" placeholder="Ex. 10:00 AM - 11:00 AM"><br>
														<input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Submit Schedule"><br><br>
													</div>
										</form>
									</div>
								</div>
							</div>				
						</div>

					</div>
			</main>
	</div>
@endsection

@section('scripts')
<script src="{{asset('import/js/app.js')}}"></script>
@endsection
