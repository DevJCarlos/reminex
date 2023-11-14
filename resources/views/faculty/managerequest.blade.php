@extends('layouts.guest2')

@section('content')
<div class="main">
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Manage<strong> Reschedules</strong></h1>

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <label for="request"><strong class="text-success">Your Student Requests </strong></label><br><br>
                            @foreach($requestrecords2 as $requestrecord2)
                            @if($requestrecord2->instructor == auth()->user()->name)
                            @if($requestrecord2->request_type === "Reschedule Request")
                            @if ($requestrecord2->status === "Approved" || $requestrecord2->status === null)

                            <div class="row">
                                <div class="col-12 col-lg-10">
                                    <form action="{{ route('sched.store') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button type="button" class="collapsible">
                                            <div class="row">
                                                <div class="col-6">{{ $requestrecord2->stud_name }}</div>
                                                <div class="col-3">
                                                    @if($requestrecord2->status === null)
                                                    <p class="badge badge-warning" style="font-size:15px">Pending</p>
                                                    @endif
                                                    @if($requestrecord2->status === "Approved")
                                                    <p class="badge badge-success" style="font-size:15px"> {{ $requestrecord2->status }}</p>
                                                    @endif
                                                </div>
                                                <div class="col-3">{{ $requestrecord2->created_at }}</div>
                                            </div>
                                        </button>
                                        <div class="content2"><br>

                                            <label for="request"><strong>Time Availability: &nbsp;</strong></label><label for="request"> {{ $requestrecord2->time_avail1}} - {{ $requestrecord2->time_avail2}}</label><br>
                                            <label for="request"><strong>Name: &nbsp;</strong></label><br>
                                            <input type="text" class="form-control" name="stud_name2" value="{{ $requestrecord2->stud_name }}" readonly><br>
                                            <label for="request"><strong>Request Type: &nbsp;</strong></label><br>
                                            <input type="text" class="form-control" name="request_type2" value="{{ $requestrecord2->request_type }}" readonly><br>
                                            <label for="request"><strong>Subject to Take: &nbsp;</strong></label><br>
                                            <input type="text" class="form-control" name="subject2" value="{{ $requestrecord2->subject }}" readonly><br>
                                            <label for="request"><strong>Instructor: &nbsp;</strong></label><br>
                                            <input type="text" class="form-control" name="instructor2" value="{{ $requestrecord2->instructor }}" readonly><br>

                                            <label for="request"><strong>Exam Day: &nbsp;</strong></label>
                                            <input type="date" class="form-control" name="exam_day" class="calendar" min="{{ date('Y-m-d') }}" required><br>
                                            <label for="request"><strong>Exam Time: &nbsp;</strong></label><br>
                                            <input type="time" name="exam_time" min="07:45" required> -
                                            <input type="time" name="exam_time2" min="07:45" required><br>

                                            <label for="request"><strong>Room: &nbsp;</strong></label><br>
                                            <select class="form-select mb-3" name="room" required>
                                                <option disabled selected>Select Room...</option>
                                                @foreach ($rooms as $room)
                                                <option value="{{ $room->room_name }}">{{ $room->room_name }}</option>
                                                @endforeach
                                            </select>

                                            <input type="submit" class="btn btn-primary btn-lg form-control" onclick="toggleSendButton(); return confirm('Are you sure to create this new schedule?')" value="Create New Schedule"><br><br>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-lg-1">
								<!-- <a href="{{ route('newsched_created', $requestrecord2->id) }}" class="btn btn-warning" style="font-size:10px">Notify Student</a><br><br> -->
                                <!-- <a href="{{ route('newsched_created', $requestrecord2->id) }}" class="btn btn-warning" style="font-size:10px" onclick="notifyStudent({{ $requestrecord2->id }}, '{{ $requestrecord2->subject }}', '{{ $requestrecord2->stud_name }}')">Notify Student</a><br><br> -->
                                <button id="notifyStudentButton" class="btn btn-warning" style="font-size:10px" onclick="notifyStudent({{ $requestrecord2->id }}, '{{ $requestrecord2->subject }}', '{{ $requestrecord2->stud_name }}')">Finish</button><br><br>

                                </div>
                            </div>
                            @endif
                            @endif
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
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
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{asset('import/js/app.js')}}"></script>
<!-- collapsible -->
<script src="{{asset('import/js/collapse.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function notifyStudent(requestId, subject, studName) {
        // Perform an AJAX request to check if a schedule exists for the given subject and student
        $.ajax({
            type: 'GET',
            url: '/check-schedule-exists',
            data: {
                subject2: subject, // Updated to match the input name in your form
                stud_name2: studName,
            },
            success: function (response) {
                if (response.exists) {
                    // If a schedule exists, dynamically set the button click behavior
                    $('#notifyStudentButton').attr('onclick', 'window.location.href=\'{{ route("newsched_created", ":id") }}\'.replace(":id", ' + requestId + ')');
                    $('#notifyStudentButton').click();
                } else {
                    // If no schedule exists, show a message to the user
                    alert('You need to create a new schedule first.');
                }
            },
            error: function (error) {
                console.error('Error checking schedule:', error);
            }
        });
    }
</script>


@endsection
