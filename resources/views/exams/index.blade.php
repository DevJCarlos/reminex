@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<!-- <div class="container"> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Exam Schedule Table</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dropdown1" class="text-right">Select Period:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="dropdown1" name="option1">
                                        <option value="none">--Select Period--</option>
                                        <option value="Prelims">Prelims</option>
                                        <option value="Midterms">Midterms</option>
                                        <option value="Pre-Finals">Pre-Finals</option>
                                        <option value="Finals">Finals</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dropdown2" class="text-right">Select Day:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" id="dropdown2" name="option2">
                                        <option value="none">--Select Day--</option>
                                        <option value="1">Day 1</option>
                                        <option value="2">Day 2</option>
                                        <option value="3">Day 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-success">Excel</button>
                </div>
                <div class="card-body">
                    <table class = "table table-bordered" id = "schedule">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Subject</th>
                                <th>Rooms</th>
                                <th>Section</th>
                                <th>Section Number</th>
                                <th>Instructor</th>
                                <th>Student Count</th>
                                <!-- <th>Proctors</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                        </tbody>
                    
                    </table>
                    <br>
                    <button type="submit" onclick="handleFormSubmit();" class="btn btn-success" style="width: 150px;">Find Schedule</button>
                    <button type="submit" class="btn btn-success" style="width: 150px;">Release To Students</button>
                    
                </div>
                
            </div> 
        </div>
    </div>
<!-- </div> -->


@endsection

@section('scripts')

<script>

    var selectedValues = [];
    var selectedValuesDay = [];
    
    function getValue() {
        selectedValues = [$('#dropdown1').val()];
        selectedValuesDay = [$('#dropdown2').val()];
        // handleFormSubmit();

        console.log('sent',selectedValues,selectedValuesDay );

    }
    
    $(document).ready(function() {
        $('#dropdown2').change(function() {
            selectedOption1 = $('#dropdown2 option:selected').text();
            if (selectedOption1 === "Day 1" || selectedOption1 === "Day 2" || selectedOption1 === "Day 3" || selectedOption1 === "Select All") {
                getValue();
                // if (selectedValuesDay) {
                //     handleFormSubmit();
                // }
            }
        });

        $('#dropdown1').change(function() {
            selectedOption = $('#dropdown1 option:selected').text();
            if (selectedOption === "Prelims" || selectedOption === "Midterms" || selectedOption === "Pre-Finals" || selectedOption === "Finals") {
                getValue();
                // if (selectedValues) {
                //     handleFormSubmit();
                // }
            }
        });
        
    });

    function handleFormSubmit() {
        
        var period = selectedValues; 
        var day = selectedValuesDay;

        console.log('sent',period,day );
        if (period == 'none' || day == 'none') {
        alert('Please Select Period and day');
        location.reload();
        }
        
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: '{{ route('exams.fetch') }}', 
            type: 'POST', 
            data: { period: period, day: day },
            dataType: 'json',
            success: function(data) {
            if (data && data.examTimes && data.examTimes.length > 0) {
            
            console.log(data.examTimes);
            } else {
            alert("No data. Please create a schedule first.");
            window.location.href = '{{ route('exam.create') }}';
            }

            console.log('response from server',data);

            var TimeSchedule = [];
            data.examTimes.forEach(function(examTime) {
                
                var TimeRooms = [];
                
                // console.log('test examtimes ni',data.examTimes);
                examTime.exam_rooms.forEach(function(examRoom) {
                    // console.log('new',examRoom);
                    TimeRooms.push([examRoom.room_name]);
                });
                
                var Sections = [];
                examTime.exam_sub.forEach(function(subject) {

                    subject.exam_sectionss.forEach(function(subjectSec) {
                        Sections.push({
                            Subject_name: subject.subject_name,
                            Section: subjectSec.section_name,
                            Code: subjectSec.class_num,
                            Instructor: subjectSec.Instructor,
                            StudentCount: subjectSec.class_count
                        });
                    });

                  
                  
                });

                TimeSchedule.push({
                Time: examTime.exam_time,
                Subjects: Sections,
                Rooms: TimeRooms,
                        
                });
            });

            console.log('TimeSchedule Data',TimeSchedule);

            const tableBody = document.getElementById('tableBody');

            TimeSchedule.forEach((timeSlots) => {
                // console.log(timeSlots);
                    
                timeSlots.Subjects.forEach((subject, index) => {
                    const row = document.createElement('tr');
                        
                    if (index === 0) {
                    const timeCell = document.createElement('td');
                    timeCell.rowSpan = timeSlots.Rooms.length;
                    timeCell.textContent = timeSlots.Time;
                    row.appendChild(timeCell);
                    }
                        

                    // Subject
                    const subjectCell = document.createElement('td');
                    subjectCell.textContent = subject.Subject_name;
                    row.appendChild(subjectCell);
                            

                    // Room
                    // console.log('data',timeSlots.Rooms);
                    const roomCell = document.createElement('td');
                    roomCell.textContent = timeSlots.Rooms[index]; 
                    row.appendChild(roomCell);

                    // Section
                    const sectionCell = document.createElement('td');
                    sectionCell.textContent = subject.Section;
                    row.appendChild(sectionCell);

                    // Section Number
                    const sectionNumberCell = document.createElement('td');
                    sectionNumberCell.textContent = subject.Code;
                    row.appendChild(sectionNumberCell);

                    // Instructor
                    const instructorCell = document.createElement('td');
                    instructorCell.textContent = subject.Instructor;
                    row.appendChild(instructorCell);

                    // Class Count
                    const classCountCell = document.createElement('td');
                    classCountCell.textContent = subject.StudentCount;
                    row.appendChild(classCountCell);

                    // Edit Button
                    const editCell = document.createElement('td');
                    const editButton = document.createElement('button');
                    editButton.textContent = 'Edit';
                    editButton.addEventListener('click', () => handleEditClick(timeSlots.Rooms[index])); // Replace with your edit logic
                    editCell.appendChild(editButton);
                    row.appendChild(editCell);

                            
                    tableBody.appendChild(row);
                    });   
                        
                });

                //function for button
                function handleEditClick(subject) {
                    // Implement your logic for handling the edit button click here
                    console.log('Edit clicked for subject:', subject);
                }

            },

            error: function() {
                console.log('Error fetching data');
            }
        });
    }
   

</script>
@endsection