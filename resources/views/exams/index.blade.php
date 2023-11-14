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
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Excel</button>
                        <button type="submit" onclick="handleFormSubmit();" class="btn btn-success" style="width: 150px;">Find Schedule</button>
                    </div>
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
                    <button type="submit" class="btn btn-success" style="width: 150px;">Release To Students</button>
                    <button type="button" class="btn btn-danger" onclick="deleteExamDay();">Delete Exam Day</button>
                    
                </div>
                
            </div> 
        </div>
    </div>
<!-- </div> -->
<div id="editModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="roomDropdown">Select Room:</label>
                <select id="roomDropdown" class="form-select">
                    <!-- Options will be dynamically generated in JavaScript -->
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateRoom()">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

<script>

    var selectedValues = [];
    var selectedValuesDay = [];
    
    function getValue() {
        selectedValues = [$('#dropdown1').val()];
        selectedValuesDay = [$('#dropdown2').val()];
        // handleFormSubmit();

        // console.log('sent',selectedValues,selectedValuesDay );

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
    var TimeSchedule = [];
    var alterSchedule = [];
    function handleFormSubmit() {
        var period = selectedValues; 
        var day = selectedValuesDay;

        // console.log('sent',period,day );
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
            console.log('Success');
            } else {
            alert("No data. Please create a schedule first.");
            
            }

            // var TimeSchedule = [];
            // var alterSchedule = [];
            data.examTimes.forEach(function(examTime) {
                var TimeRooms = [];
                var TimeIDs = [];
                var SeCount = [];
                var alterRooms = [];
                var resultArray = [];

                examTime.exam_rooms.forEach(function(examRoom) {
                    // console.log('new',examRoom);
                    TimeRooms.push([examRoom.room_name]);
                    TimeIDs.push([examRoom.id]);

                    alterRooms.push([examRoom.id, examRoom.room_name]);
                });
                var Sections = [];
                var alterSec = [];
                var alterCount = [];
                var alterSub = [];
                examTime.exam_sub.forEach(function(subject) {
                    subject.exam_sectionss.forEach(function(subjectSec) {
                        Sections.push({
                            Subject_name: subject.subject_name,
                            Section: subjectSec.section_name,
                            Code: subjectSec.class_num,
                            Instructor: subjectSec.Instructor,
                            StudentCount: subjectSec.class_count
                        });
                        // if (!subjectSec.class_count.includes(',')) {
                        alterSec.push([
                            subjectSec.section_name,
                        ]);
                        alterCount.push([
                            subjectSec.class_count,
                        ]);
                        alterSub.push([
                            subject.subject_name,
                        ]);
  
                    });

                });
                TimeSchedule.push({
                Time: examTime.exam_time,
                Subjects: Sections,
                Rooms: TimeRooms,
                RoomIDs: TimeIDs,
                        
                });
                
                alterSchedule.push({
                    Time: examTime.exam_time,
                    Section: alterSec,
                    Count: alterCount,
                    Rooms: alterRooms,
                    Sub: alterSub,
                });
                
            });
           
            // console.log('alter Data',alterSchedule);
            // console.log('TimeSchedule Data',TimeSchedule);


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
                    // console.log('data',timeSlots.RoomIDs);
                    const roomCell = document.createElement('td');
                    roomCell.textContent = timeSlots.Rooms[index] || timeSlots.RoomIDs[index];
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
                    editButton.addEventListener('click', () => handleEditClick(timeSlots.Rooms[index], timeSlots.RoomIDs[index], subject.Subject_name, subject.StudentCount, subject.Section, timeSlots.Time));
                    editCell.appendChild(editButton);
                    row.appendChild(editCell);

                    tableBody.appendChild(row);
                    });   
                        
                });
            },

            error: function() {
                console.log('Error fetching data');
            }
        });
    }   
    
                
    var editedRoomID, editedRoomName, roomOption, time, Subject_name, Section_name, Student_count;
    var editedRoomIDString,editedRoomNameString, SelectedRoom;

    function handleEditClick(roomName, roomID, timeslot, subject, section, studentcount) { 
        editedRoomID = roomID;
        editedRoomName = roomName;
        editedRoomIDString = editedRoomID.join(',');
        editedRoomNameString = editedRoomName.join(',');
                    
        timeId = timeslot;
        Subject_name = subject;
        Section_name = section;
        Student_count = studentcount;
        SelectedRoom;
        // console.log('section', Section_name);
                    
                    
            if (Section_name.includes(',')) {
                window.alert("Can't select an already merged Section");
                location.reload();
            } else {
            SelectedRoom = [timeId,parseInt(editedRoomIDString,10),editedRoomNameString,parseInt(Subject_name,10),Section_name,Student_count];
            }
            // console.log('selected room: ',SelectedRoom);
            var RoomCon = [];
            alterSchedule.forEach(function (Time) {
            var combinedData = [];

            for (var i = 0; i < Time.Count.length; i++) {
                if (!Time.Count[i][0].includes(',')) {
                    combinedData.push([parseInt(Time.Count[i][0], 10), Time.Sub[i][0], Time.Section[i][0], Time.Rooms[i][0], Time.Rooms[i][1]]);
                }
            }
            RoomCon.push({
            Time: Time.Time,
            Data: combinedData,
            })
        });

        const duplicatedData = [];
        const roomOptions = [];
        RoomCon.forEach(function (timeData) {
            if (timeData.Time.includes(SelectedRoom[5])) {
                const currentCapacity = SelectedRoom[3];
                timeData.Data.forEach((roomData) => {
                    const roomCapacity = roomData[0];
                    const isSameRoom = JSON.stringify(roomData[3]) === JSON.stringify(SelectedRoom[1]);
                    // console.log('same data',SelectedRoom);

                    if (!isSameRoom && currentCapacity + roomCapacity <= 50) {
                        roomOptions.push([
                        roomData[4],
                        roomData[1],
                        SelectedRoom[1]
                        ]);
                    console.log('duplicateData1',roomOptions);
                        } else if (isSameRoom) {
                        duplicatedData.push([
                        roomData[4],
                        roomData[1],
                        roomData[3]
                        ]);
                    // console.log('duplicateData',duplicatedData);
                    }
                });
            }

                        
        });

                    
        // console.log('Duplicated Data:', duplicatedData);
        // console.log('Check loggers', RoomCon);
        var dropdown = document.getElementById('roomDropdown');
        for (var i = 0; i < roomOptions.length; i++) {
        var option = document.createElement('option');
        option.value = [roomOptions[i][0], roomOptions[i][2]];
        option.text = roomOptions[i][0] + ' (' + roomOptions[i][1] + ')';
        dropdown.add(option);
                   
        }
        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }

    function updateRoom() {
        var selectedRoom = document.getElementById('roomDropdown').value;
        var [roomName, roomID] = selectedRoom.split(',');

        // console.log('Room Name: ', roomName);
        // console.log('Room ID: ', roomID);
        
        $.ajax({
                url: '/update-examroom', 
                method: 'POST',
                data: { roomName: roomName, roomID: roomID },
                success: function (response) {
                    window.alert("Room Updated");
                    location.reload();
                },
                error: function (error) {
                    
                    window.alert('Error updating ExamRoom:', error);
                    location.reload();
                }
            });

        var dropdown = document.getElementById('roomDropdown');
        dropdown.options.length = 0;

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.hide();
    }

    function deleteExamDay() {
            
            var period = document.getElementById('dropdown1').value;
            var day = document.getElementById('dropdown2').value;
            var confirmDelete = confirm('Are you sure you want to delete this Exam Schedule?');


        if (confirmDelete) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            
            $.ajax({
                method: 'POST',
                url: '/delete-exam-day', 
                data: { period: period, day: day },
                success: function(response) {
                if (response.message === 'Exam day deleted successfully') {
                        window.alert('Deleted Successfully'); 
                    } else if (response.message === 'No matching exam day found') { 
                    window.alert('No Data of ' + period + ' Day ' + day + ' in Database '); 
                    location.reload();
                }
                },
                error: function(error) {
                    console.error('Error deleting exam day:', error);
                    
                }
            });
        }
    }
   

</script>
@endsection