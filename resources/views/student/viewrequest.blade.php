@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">

			    <h1 class="h3 mb-3"><strong>Your Requests</strong></h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
							  <div class="card-body text-danger">
								<div class="table-responsive">
								  <table
									id="zero_config"
									class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Request Type</th>
                                            <th>Subject</th>
                                            <th>Instructor</th>
                                            <th>Requirements</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>   
                                                <td>
                                                    <a href="#">
                                                    <input type="submit" class="btn btn-secondary" value="Download">
                                                    </a>
                                                </td>    
                                                <td></td>          
                                            </tr> 
                                            </tbody>                 
								  </table>
								</div>
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