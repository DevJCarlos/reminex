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
					</div>	

					<h1 class="h3 mb-3">Capstone Project Members</h1>
					<div class="row">
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="img/photos/members/basan.jpg" alt="Admin" class="rounded-circle" width="150">
									<div class="mt-3">
									<h4>Gian Rogel Y. Basan</h4>
									<p class="text-secondary mb-1">BS in Information Technology</p>
									<p class="text-secondary mb-1">STI College General Santos</p>
									<p class="text-muted font-size-sm">gbasan008@gmail.com</p>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="img/photos/members/ano.jpg" alt="Admin" class="rounded-circle" width="150">
									<div class="mt-3">
									<h4>Ryan Jun A. Año</h4>
									<p class="text-secondary mb-1">BS in Information Technology</p>
									<p class="text-secondary mb-1">STI College General Santos</p>
									<p class="text-muted font-size-sm">ryan.rain79@gmail.com</p>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="img/photos/members/degamo.jpg" alt="Admin" class="rounded-circle" width="150">
									<div class="mt-3">
									<h4>Maedy Luna E. Degamo</h4>
									<p class="text-secondary mb-1">BS in Information Technology</p>
									<p class="text-secondary mb-1">STI College General Santos</p>
									<p class="text-muted font-size-sm">Degamo.2384140@gmail.com</p>
									</div>
								</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="img/photos/members/begtasen.jpg" alt="Admin" class="rounded-circle" width="150">
									<div class="mt-3">
									<h4>Rhea Mave C. Begtasen</h4>
									<p class="text-secondary mb-1">BS in Information Technology</p>
									<p class="text-secondary mb-1">STI College General Santos</p>
									<p class="text-muted font-size-sm">rheamavec@gmail.com</p>
									</div>
								</div>
								</div>
							</div>
						</div>

						<h1 class="h3 mb-3">Contact Us</h1>
						<div class="row">
							<div class="col-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">Email:</h5>
										<p class="text-secondary mb-1">sti.gensan@gmail.com</p><br>
										<h5 class="card-title mb-0">Call:</h5>
										<p class="text-secondary mb-1">(083) 554 3038</p><br>
										<h5 class="card-title mb-0">Location:</h5>
										<p class="text-secondary mb-1">J. Catolico Avenue, General Santos City, 9500</p><br>
									</div>
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
