@extends('layouts.guest')

@section('content') 
        <div class="main">
            <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>About Us</strong></h1>

					<div class="row">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">ReminEx is an Exam Reminder and Scheduling Management System that 
										provides a comprehensive solution for scheduling exams, managing conflicts, and facilitating 
										rescheduling requests. By incorporating an efficient algorithm and considering various constraints, 
										the system streamlines the exam management process, ensuring accuracy, transparency, and optimal 
										resource utilization. </h5>
								</div>
							</div>
						</div>	
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									<div class="testimonial-item">
										<div class="col-12">
											<img src="img/photos/members/basan.png" class="testimonial-img" width="100" alt=""  class="col-12">
										</div>
										<h3>Gian Rogel Y. Basan</h3>
										<h4>STI College Gensan - BSIT Student</h4><br>
										<h4>Calumpang, General Santos City</h4>
										<h4>gbasan008@gmail.com</h4>
										<h4>09972282229</h4>
										<p>
										  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
										  Verify and Execute. Ipasa mi Sir Dan!
										  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									
								</div>
							</div>
						</div>	
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									
								</div>
							</div>
						</div>		
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									
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
