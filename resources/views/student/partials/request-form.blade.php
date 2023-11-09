<form action="{{ route('request.store') }}"  method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
	    <p class="text-danger"><em>*Note: You can only make one request per subject.</em></p>
            <label for="request"><strong>Name: </strong></label><br>
                <input type="text" class="form-control" name="stud_name" value="{{ auth()->user()->name }}" readonly><br>
            <label for="request"><strong>Department: </strong></label><br>
                <input type="text" class="form-control" name="department" value="{{ auth()->user()->department }}" readonly><br>

			<label for="request"><strong>Request Type: </strong></label>
				<select class="form-select mb-3" name="request_type" required>
					<option disabled selected>Select Request...</option>
					<option value="Reschedule Request">Reschedule Request</option>
					<option value="Special Exam Request">Special Exam Request</option>
				</select>
			<label for="request"><strong>Subject to Take: </strong></label><br>
                <!-- <input type="text" name="subject" placeholder="Please input subject..."><br><br> -->

                <select class="form-select mb-3" name="subject" required>
                    <option disabled selected>Select Subject...</option>
                        <option value="ITSM">ITSM</option>
                        <option value="ITSM">Programming Languages</option>
                        <option value="ITSM">Info Assurance and Security</option>
                        <option value="ITSM">Mobile Systems and Technology</option>
                        <option value="ITSM">Game Development</option>
                    </select>

            <label for="request"><strong>Instructor: </strong></label>
                <select class="form-select mb-3" name="instructor" required>
                    <option disabled selected>Select Instructor...</option>
                    @php
                        $sortedUserRecords = $userrecords->sortBy('name');
                    @endphp
                    @foreach($sortedUserRecords as $userrecord)
                        @if($userrecord->role === "teacher" || $userrecord->role === "admin")
                            <option value="{{$userrecord->name}}">{{ $userrecord->name }}</option>
                        @endif
                    @endforeach
                </select>

            <label for="request"><strong>Reason: </strong></label> <p class="text-danger"><em>(if subject conflict, please include the details)</em></p>
				<textarea class="form-control" rows="2" name="reason" placeholder="Reason details here..." required></textarea><br>

			<label for="request"><strong>Time Available (Ranged): </strong></label>
				<textarea class="form-control" rows="2" name="time_available" placeholder="Ex. 10:00 AM - 11:00 AM"  required></textarea><br>

			<label class="col-md-3"><strong>Requirements: </strong></label><br>
                <input type="file" id="fileInput" name="requirement" accept=".pdf, .docx" onchange="displayFileName()">
                    <label for="fileInput" class="custom-file-input">Choose File</label>
                    
		<p class="text-danger"><em>*Requirements should be in one (1) file only, either in .docx or .pdf format. It must include your <strong>request letter</strong>, <strong>photocopy of your guardian's ID with guardian's signature below</strong>, <strong>proof of your excuse (e.g. Medical Certificate)</strong>, and your <strong>exam permit</strong>.</em></p>
        <p class="text-danger"><em>*For those <strong>subject conflict</strong> as reason, you can only submit your <strong>exam permit</strong>.</em></p>
		<br>
				<input type="submit" class="btn btn-warning btn-lg form-control" onclick="return confirm('Do you confirm to send this request?')" id="sendRequest" value="Submit Request">
</form>