@extends('layouts.guest2')

@section('content')


        <div class="main">
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Change Password</strong></h1>

					<div class="row">
						<div class="col-12 col-lg-8">
							<div>
								@if ($errors->any())
								<div>
									@foreach ($errors->all() as $error)
									<div class="alert alert-danger">{{$error}}</div>                               
									@endforeach
								</div>
								@endif
					
								@if (session()->has('error'))
								<div class="alert alert-danger">{{session('error')}}</div>                       
								@endif
					
								@if (session()->has('success'))
								<div class="alert alert-success">{{session('success')}}</div>                       
								@endif
							</div>
						</div>
						<div class="col-12 col-lg-8">
							<div class="card">
								<div class="card-body">
									<form action="{{ route('password.change2') }}" method="POST">
										@csrf
										<!-- Old Password input -->
										<label for="old_password"><strong>Old Password: </strong></label>
										<input type="password" name="old_password" class="form-control" placeholder="Input Here" required><br>

										<!-- New Password input -->
										<label for="new_password"><strong>New Password: </strong></label>
										<input type="password" name="new_password" class="form-control" placeholder="Input Here" required><br>    

										<!-- Confirm Password input -->
										<label for="confirm_password"><strong>Confirm Password: </strong></label>
										<input type="password" name="confirm_password" class="form-control" placeholder="Input Here" required><br><br>
										
										<input type="submit" class="btn btn-warning btn-lg" id="sendRequest" value="Submit">
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