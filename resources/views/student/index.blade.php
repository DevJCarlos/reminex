@extends('layouts.guest')

@section('content')
{{-- <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('import/img/photos/ReminExlogolink2.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>ReminEx</title>

	<link href="{{asset('import/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head> --}}



	<div class="main">
		<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong class="text-warning">Reminex</strong> Dashboard</h1>

					<div class="row">
						<div class="col-7">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Exam Schedule is <span class="badge bg-warning">Not Yet Available</span>.</h5>
								</div>
							</div>
						</div>			
						
						<div class="col-5">
							<div class="card">
								<div class="card-header">
									<h2 class="col-12 badge bg-danger" id="spetitle"><strong>SPE REMINDERS for the STUDENTS</strong></h2><br><br>
									<h4><strong>1.</strong> Students must be at the assigned exam room at least 10 minutes before the exam time.</h4>
									<h4><strong>2.</strong> No Premit, No Exam will be <strong class="text-danger">STRICTLY IMPLEMENTED</strong>.</h4>
									<h4><strong>3.</strong> <strong class="text-danger">Rescheduling of Exam </strong>within the 3-day exam period is <strong class="text-danger">allowed</strong>
										 for students with conflicts in the exam schedule due to another exam, work <span class="text-success">(present Certificate of Employment)</span> , 
										 or late payment. Secure <strong class="text-danger">Rescheduling Form</strong> from your Program Head (PH) <strong class="text-danger">before</strong>
										 the exam schedule. Otherwise, it will be considered as Special Exam, subject for deduction.</h4>
									<h4><strong>4.</strong> Exam taken after 3-day exam period is considered <strong class="text-danger">Special Exam (only 85% of exam score will be recorded)</strong>.
										 Special Exam shall secure an approved Rescheduling Form. <span class="text-success">(See your Program Head to secure the form)</span>.</h4>
									<h4><strong>5.</strong> Students who would like to take <strong class="text-danger">Special Exam </strong> shall secure an Approved Rescheduling Form.
										<span class="text-success">(See your Program Head to secure the form)</span></h4><br>

										<h4>Requirements for securing Rescheduling Form (<strong class="text-danger">Special Exam</strong>):</h4><br>
										<h5>a. Excuse letter addressed to Program Head stating the <strong class="text-danger">valid reason </strong>of missing the exam schedule, signed by parent/guardian.</h5>
										<h5>b. Supporting document (<strong class="text-danger">to consider as valid reason</strong>) attached to the letter can be any of the following:
											<strong class="text-success">medical certificate, death certificate, or medical slip </strong>(<span class="text-success">from STI clinic if sickness happens while 
											taking the exam, the student must see the school nurse before going home</span>).</h5>
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