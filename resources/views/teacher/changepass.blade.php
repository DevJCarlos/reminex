@extends('layouts.guest2')

@section('content')


        <div class="main">
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Change Password</strong></h1>

					<div class="row">
						<div class="col-12 col-lg-5">
							<div class="card">
								<div class="card-body">
									<form action="#" method="#">
										<label for="request"><strong>Current Password: </strong></label>
										<input type="text" class="form-control" placeholder="Input Here"><br>
										<label class="col-md-3"><strong>New Password: </strong></label>
										<input type="text" class="form-control" placeholder="Input Here"><br>	
										<label class="col-md-3"><strong>Confirm Password: </strong></label>
										<input type="text" class="form-control" placeholder="Input Here"><br><br>
										
										<input type="submit" class="btn btn-warning btn-lg" id="sendRequest" value="Submit">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
	    </div>

<script src="js/app.js"></script>

	
</body>

@endsection