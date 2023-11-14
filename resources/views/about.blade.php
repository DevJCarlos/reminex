@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('ABOUT US') }}</strong></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
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
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
								<div class="card-header">
									<h5 class="card-title mb-0"><strong>Contact Us</strong></h5>
								</div><br>
                                    <h5 class="card-title mb-0"><strong>Email:</strong></h5>
							            <p>sti.gensan@gmail.com</p><br>
							        <h5 class="card-title mb-0"><strong>Call:</strong></h5>
							            <p>(083) 554 3038</p><br>
							        <h5 class="card-title mb-0"><strong>Location:</strong></h5>
							            <p>J. Catolico Avenue, General Santos City, 9500</p><br><br><br><br>
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
									<img src="{{asset('import2/img/testimonials/basan.jpg')}}" alt="Admin" class="rounded-circle" width="150">
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
									<img src="{{asset('import2/img/testimonials/ano.jpg')}}" alt="Admin" class="rounded-circle" width="150">
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
									<img src="{{asset('import2/img/testimonials/degamo.jpg')}}" alt="Admin" class="rounded-circle" width="150">
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
									<img src="{{asset('import2/img/testimonials/begtasen.jpg')}}" alt="Admin" class="rounded-circle" width="150">
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
                </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection