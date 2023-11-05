@extends('layouts.guest2')

@section('content')

			<div class="main">
					<main class="content">
						<div class="container-fluid p-0">

							<h1 class="h3 mb-3">Requests <strong>Archive</strong></h1>

							<div class="row">
								<div class="col-7">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0"><strong class="text-warning">Requests</strong></h5><br><br>

												<form action="#" method="#">
													<button type="button" class="collapsible">
														<div class="row">
															<div class="col-9">Basan, Gian Rogel Y. </div>
															<div class="col-3"><span class="badge bg-secondary">10/10/23 10:00 AM</span></div>
														</div>
													</button>
														<div class="content2"><br>
															<label for="request"><strong>Request Type: &nbsp;</strong></label><label for="request"> Reschedule Request</label><br>
															<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> Event-Driven Programming</label><br>
															<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> Mr. Elbert Gumban</label><br>
															<label for="request"><strong>Exam Day:  &nbsp;</strong></label><label for="request"> 10:00 AM - 12:00 PM</label><br>
															<label for="request"><strong>Exam Time:  &nbsp;</strong></label><label for="request"> 10:00 AM - 12:00 PM</label><br>
															<label for="request"><strong>Remarks:  &nbsp;</strong></label><label class="badge bg-success" for="request"> New Schedule Created</label><br><br>
														</div>
												</form>
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

