@extends('layouts.guest2')

@section('content')

			<div class="main">
				<main class="content">
					<div class="container-fluid p-0">

						<!-- <h1 class="h3 mb-3"><strong class="text-warning">Reminex</strong> Dashboard</h1>

						<div class="row">
							<div class="col-7">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Exam Schedule <span class="badge bg-warning">Not Yet Available</span>.</h5>
									</div>
								</div>
							</div>					
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h4>Exam Schedule Table</h4>
									</div>
									<div class="card-body">
										<form>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="dropdown1" class="text-right">Select Period:</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<select class="form-control" id="dropdown1" name="option1">
															<option value="none">--Select Period--</option>
															<option value="Prelims">Prelims</option>
															<option value="Midterms">Midterms</option>
															<option value="Pre-Finals">Pre-Finals</option>
															<option value="Finals">Finals</option>
														</select>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="dropdown2" class="text-right">Select Day:</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<select class="form-control" id="dropdown2" name="option2">
															<option value="none">--Select Day--</option>
															<option value="1">Day 1</option>
															<option value="2">Day 2</option>
															<option value="3">Day 3</option>
														</select>
													</div>
												</div>
											</div>
										</form>
										<div class="d-flex justify-content-between">
											<button type="submit" class="btn btn-success">Excel</button>
											<button type="submit" onclick="handleFormSubmit()" class="btn btn-success" style="width: 150px;">Find Schedule</button>
										</div>
									</div>
									<div class="card-body">
										<table class = "table table-bordered" id = "schedule">
											<thead>
												<tr>
													<th>Time</th>
													<th>Subject</th>
													<th>Rooms</th>
													<th>Section</th>
													<th>Section Number</th>
													<th>Instructor</th>
													<th>Student Count</th>
													<!-- <th>Proctors</th> -->
													<th>Actions</th>
												</tr>
											</thead>
											<tbody id="tableBody">

											</tbody>
										
										</table>
										<br>
								
										
									</div>
									
								</div> 
							</div>
						</div>

					</div>
				</main>
			</div>
			

			 

<script src="{{asset('import/js/app.js')}}"></script>

<script>
	function handleFormSubmit() {			
    var period = document.getElementById('dropdown1').value;
    var day = document.getElementById('dropdown2').value;
    
    
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $.ajax({
        method: 'POST',
        url: '/pull-exam-sched', 
        data: { period: period, day: day },
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            
        },
        error: function(error) {
            console.error(error);
        }
    });
}

</script>

@endsection


