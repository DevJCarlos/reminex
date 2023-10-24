<!doctype html>
<html lang="en">
  <head>
  	<title>Reminex Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="{{asset('import/img/photos/ReminExlogolink3.png')}}"
    />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('import2/css2/style.css')}}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">
						<img src="{{asset('import/img/photos/loginlogoadmin.png')}}" 
						alt="loginlogo"
						width="200px"
						>
					</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Admin Login</h3>
						<form action="#" method="POST" class="login-form" id="loginform">
							<div class="mt-3">
								@if ($errors->any())
									<div class="col-12">
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
					@csrf
		      		<div class="form-group">
		      			<input type="number" class="form-control rounded-left" placeholder="Admin IDN" name="adminidn" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
	            </div>
	            <div class="form-group d-md-flex">
					<div>
						<a href="#">Forgot Password</a>
					</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

    <script src="{{asset('import2/js2/jquery.min.js')}}"></script>
  <script src="{{asset('import2/js2/popper.js')}}"></script>
  <script src="{{asset('import2/js2/bootstrap.min.js')}}"></script>
  <script src="{{asset('import2/js2/main.js')}}"></script>

	</body>
</html>

