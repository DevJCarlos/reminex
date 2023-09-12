@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Create Request</strong></h1>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="index.html" method="#">
                                    <p class="text-danger"><em>*Note: You can only make one request per subject.</em></p>
                                    <label for="request"><strong>Request Type: </strong></label>
                                    <select class="form-select mb-3" required>
                                        <option disabled selected>Select Request...</option>
                                        <option value="Reschedule Request">Reschedule Request</option>
                                        <option value="Special Exam Request">Special Exam Request</option>
                                    </select>
                                    <label for="request"><strong>Subject to Take: </strong></label>
                                    <select class="form-select mb-3" required>
                                        <option disabled selected>Select Subject...</option>r 
                                        <option value="Mathematics">Mathematics</option>
                                        <option value="Physics">Physics</option>
                                    </select>			
                                    <label for="request"><strong>Instructor: </strong></label>
                                    <select class="form-select mb-3" required>
                                        <option disabled selected>Select Instructor...</option>r 
                                        <option value="Iglesias">Ms. Chola Marie Iglesias</option>
                                        <option value="Gumban">Mr. Elbert Gumban</option>
                                        <option value="Lacsina">Ms. Ivy Lacsina</option>
                                    </select>
                                    <label for="request"><strong>Reason: </strong></label>
                                    <textarea class="form-control" rows="2" placeholder="Type your reason/message here..." required></textarea><br>
                                    <label class="col-md-3"><strong>Exam Permit: </strong></label>
                                            <div class="custom-file">
                                                <input
                                                type="file"
                                                class="custom-file-input"
                                                id="validatedCustomFile"
                                                required
                                                />
                                                <label
                                                class="custom-file-label"
                                                for="validatedCustomFile"
                                                >Upload Exam Permit...</label
                                                >
                                                <div class="invalid-feedback">
                                                Example invalid custom file feedback
                                                </div>
                                            </div><br>
                                    <label class="col-md-3"><strong>Requirements: </strong></label>
                                            <div class="custom-file">
                                                <input
                                                type="file"
                                                class="custom-file-input"
                                                id="validatedCustomFile"
                                                required
                                                />
                                                <label
                                                class="custom-file-label"
                                                for="validatedCustomFile"
                                                >Upload Requirements...</label
                                                >
                                                <div class="invalid-feedback">
                                                Example invalid custom file feedback
                                                </div>
                                            </div>
                                            <br>
                                            <p class="text-danger"><em>*Requirements should be in one (1) file only, either in .docx or .pdf format. It must include your request letter, photocopy of your guardian's ID with guardian's signature below, and the proof of your excuse (e.g. Medical Certificate).</em></p>
                                            <br><br>
                                    <input type="submit" class="btn btn-warning btn-lg" id="sendRequest" value="Submit Request">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
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