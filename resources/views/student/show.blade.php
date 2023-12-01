@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">
            <!-- <h1 class="h3 mb-3"><strong>Exam Schedule</strong></h1> -->

                <div class="row">
                    <!-- <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Your Exam Schedule is <span class="badge bg-warning">Not Yet Available</span>.</h5>
                            </div>
                        </div>
                    </div> -->
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
                                            <h4 >Exam Date:  </h4>
											<button type="submit" onclick="handleFormSubmit()" class="btn btn-success" style="width: 150px;">Find Schedule</button>
										</div>
                                        <h4 id="examDateHeader"> </h4>
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
													
													<!-- <th>Actions</th> -->
												</tr>
											</thead>
											<tbody id="tableBody">

											</tbody>
										
										</table>
                                        
										<br>
                                        <button id="customScheduleButton" type="submit" class="btn btn-success" style="width: 150px;">Custom Schedule</button>				
									</div>
									
								</div> 
							</div>					
                </div>
			</div>
		</main>
	</div>

<script src="{{asset('import/js/app.js')}}"></script>
<script>
    var customScheduleButton = document.getElementById('customScheduleButton');
    customScheduleButton.style.display = 'none';
    customScheduleButton.addEventListener('click', function() {

        const routeUrl = '/irregstudent';
        window.location.href = routeUrl;
    });
    function handleFormSubmit() {			
        var period = document.getElementById('dropdown1').value;
        var day = document.getElementById('dropdown2').value;
        if (period == 'none' || day == 'none') {
            alert('Please Select Period and day');
            // location.reload();
            }
        
        $('#tableBody').empty();
        $('#examDateHeader').empty();
        
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            method: 'POST',
            url: '/pull-exam-sched-student', 
            data: { period: period, day: day },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        success: function(response) {
            console.log(response);
            usersSection = [response.userSection];
            // usersSection = ['BSCS 1-2AA'];
            var IrregInfo = response.irreg_info;
            // console.log('irreg',IrregInfo);

            var subjectirreg = [];
            var instructorirreg = [];
            var sectionirreg = [];


            IrregInfo.forEach((irreg) => {
            // subjectirreg = [irreg.student_subject];
            subjectirreg.push([irreg.student_subject]);
            instructorirreg.push([irreg.subject_instructor]);
            sectionirreg.push([irreg.subject_section]);
           

            });
            console.log('irreg',sectionirreg);

            
            var alterdata =[];
            var TimeSchedule = [];
            var ExamDates = [];
            // usersStatus = [response.userStatus];
            usersStatus = ['Irregular'];
            // console.log(usersStatus);
            if (usersStatus[0] === 'Regular') {
                response.examTimes.forEach(function(examTime) {
                        
                    var TimeRooms = [];
                    var TimeIDs = [];
                    var SeCount = [];
                    var alterRooms = [];
                    var Sections = [];
                    var ExamDate = [examTime.exam_day];
                        

                    examTime.exam_rooms.forEach(function(examRoom) {
                        // console.log('new',examRoom);
                        TimeRooms.push({rooms: examRoom.room_name});
                        TimeIDs.push([examRoom.id]);

                        alterRooms.push([examRoom.id, examRoom.room_name]);
                    });

                    ExamDate.forEach(function(dates) {
                        
                        
                        ExamDates.push([dates.date]);

                        
                    });
                    
                    
                    // console.log(ExamDates);
                        // console.log('timerooms',TimeRooms);
                        
                    var alterSec = [];
                    var alterCount = [];
                    var alterSub = [];
                    examTime.exam_sub.forEach(function (subject) {
                                
                        subject.exam_sectionss.forEach(function (subjectSec) {
                                    
                            Sections.push({
                                secID: subjectSec.id,
                                Subject_name: subject.subject_name,
                                Section: subjectSec.section_name,
                                Code: subjectSec.class_num,
                                Instructor: subjectSec.Instructor,
                                StudentCount: subjectSec.class_count,
                                proctor: subjectSec.proctor_name,
                
                            });
                                    
                                    
                        });
                                
                    });

                    TimeSchedule.push({
                        Time: examTime.exam_time,
                        Subjects: Sections,
                        rooms: TimeRooms
                                    
                    });
                    alterdata.push({
                    Subject : Sections
                    })
                    // console.log(TimeSchedule)    
                            
                }); 
                // console.log('TimeSchedule Data', TimeSchedule);
                var alterdatas = [];
                // var DataFiltered = [];
                // console.log('check 2',ExamDates[0][0]);
                
                TimeSchedule.forEach((Timeslot) => {
                    var DataFiltered = [];
                    const combinedData = Timeslot.rooms.map((room, index) => {
                        // console.log(Timeslot.Subjects[index].Instructor);
                        const section = Timeslot.Subjects[index].Section.split(', ');
                        // console.log('check proctor:',section);
                        
                        const hasMatchingSection = section.some(section => usersSection.includes(section));
                        // console.log('check 101',hasMatchingSection);
                        if (hasMatchingSection) {
                            // console.log('check 101',hasMatchingSection);
                            DataFiltered.push({
                                Room: room.rooms,
                                SecId: Timeslot.Subjects[index].secID,
                                Subject_name: Timeslot.Subjects[index].Subject_name,
                                Sections: Timeslot.Subjects[index].Section,
                                Code: Timeslot.Subjects[index].Code,
                                Instructor: Timeslot.Subjects[index].Instructor,
                                StudentCount: Timeslot.Subjects[index].StudentCount,
                                proctor: Timeslot.Subjects[index].proctor,
                            });
                        

                            // return null; 
                        }
                        // console.log('data',DataFiltered);

                        return {
                            Room: room.rooms,
                            SecId: Timeslot.Subjects[index].secID,
                            Subject_name: Timeslot.Subjects[index].Subject_name,
                            Sections: Timeslot.Subjects[index].Section,
                            Code: Timeslot.Subjects[index].Code,
                            Instructor: Timeslot.Subjects[index].Instructor,
                            StudentCount: Timeslot.Subjects[index].StudentCount,
                            proctor: Timeslot.Subjects[index].proctor,
                        };
                    });
                    // console.log('data',combinedData);
            

                    alterdatas.push({
                        Time: Timeslot.Time,
                        Data: DataFiltered,
                    });
                });
                
                    //exam date
                    let examDate = ExamDates[0][0];
                    let examDateHeader = document.getElementById('examDateHeader');
                    examDateHeader.textContent += examDate;
                    
                    
                    customScheduleButton = document.getElementById('customScheduleButton');

                    if (usersStatus[0] === 'Irregular') {
                    customScheduleButton.style.display = 'block'; 
                    } else {
                    customScheduleButton.style.display = 'none'; 
                    }
                    // console.log('alterdata: ',alterdatas);

                const tableBody = document.getElementById('tableBody');
                    let uniqueTimeSlots = [];
                alterdatas.forEach((timeSlots) => {
                            timeSlots.Data.forEach((subject, index) => {
                                const row = document.createElement('tr');

                                if (index === 0) {
                                    const timeCell = document.createElement('td');
                                    if (!uniqueTimeSlots.includes(timeSlots.Time)) {
                                        timeCell.rowSpan = timeSlots.Data.length;
                                        timeCell.textContent = timeSlots.Time;
                                        uniqueTimeSlots.push(timeSlots.Time);
                                    }
                                    row.appendChild(timeCell);
                                }

                                // Subject
                                const subjectCell = document.createElement('td');
                                subjectCell.textContent = subject.Subject_name;
                                row.appendChild(subjectCell);

                                // Room
                                const roomCell = document.createElement('td');
                                roomCell.textContent = subject.Room;
                                row.appendChild(roomCell);

                                // Section
                                const sectionCell = document.createElement('td');
                                sectionCell.textContent = subject.Sections;
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
                            
                                tableBody.appendChild(row);
                            });
                        });
                   
                
            }
            if((usersStatus[0] === 'Irregular')){
                window.alert("youre Ireg");
                

                response.examTimes.forEach(function(examTime) {
                        
                        var TimeRooms = [];
                        var TimeIDs = [];
                        var SeCount = [];
                        var alterRooms = [];
                        var Sections = [];
                        var ExamDate = [examTime.exam_day];
                            
    
                        examTime.exam_rooms.forEach(function(examRoom) {
                            // console.log('new',examRoom);
                            TimeRooms.push({rooms: examRoom.room_name});
                            TimeIDs.push([examRoom.id]);
    
                            alterRooms.push([examRoom.id, examRoom.room_name]);
                        });
    
                        ExamDate.forEach(function(dates) {
                            
                            
                            ExamDates.push([dates.date]);
    
                            
                        });
                        // console.log(ExamDates);
                        // console.log('timerooms',TimeRooms);
                            
                        var alterSec = [];
                        var alterCount = [];
                        var alterSub = [];
                        examTime.exam_sub.forEach(function (subject) {
                                    
                            subject.exam_sectionss.forEach(function (subjectSec) {
                                        
                                Sections.push({
                                    secID: subjectSec.id,
                                    Subject_name: subject.subject_name,
                                    Section: subjectSec.section_name,
                                    Code: subjectSec.class_num,
                                    Instructor: subjectSec.Instructor,
                                    StudentCount: subjectSec.class_count,
                                    proctor: subjectSec.proctor_name,
                    
                                });        
                            });
                                    
                        });
    
                        TimeSchedule.push({
                            Time: examTime.exam_time,
                            Subjects: Sections,
                            rooms: TimeRooms
                                        
                        });
                        alterdata.push({
                        Subject : Sections
                        })   
                                
                    }); 
                    console.log('Time:', );
                    var alterdatas = [];
                  
                    TimeSchedule.forEach((Timeslot) => {
                        var DataFiltered = [];
                        const combinedData = Timeslot.rooms.map((room, index) => {
                        const subjectName = Timeslot.Subjects[index].Subject_name;
                        const sections = Timeslot.Subjects[index].Section.split(', ');
                        const instructors = Timeslot.Subjects[index].Instructor.split(', ');

                        // Check if either section or instructor match any set of criteria
                        const sectionMatched = sections.some(section => sectionirreg.some(criteriaSet => criteriaSet.includes(section)));
                        const instructorMatched = instructors.some(instructor => instructorirreg.some(criteriaSet => criteriaSet.includes(instructor)));

                        // Include the row if either section or instructor match
                        if (sectionMatched && instructorMatched) {
                            DataFiltered.push({
                                Room: room.rooms,
                                SecId: Timeslot.Subjects[index].secID,
                                Subject_name: subjectName,
                                Sections: sections.join(', '), // Join sections back after splitting
                                Code: Timeslot.Subjects[index].Code,
                                Instructor: instructors.join(', '), // Join instructors back after splitting
                                StudentCount: Timeslot.Subjects[index].StudentCount,
                                proctor: Timeslot.Subjects[index].proctor,
                            });
                        }
                    });
                        // console.log('data',combinedData);
                
                        alterdatas.push({
                            Time: Timeslot.Time,
                            Data: DataFiltered,
                        });
                    });
                    console.log(alterdatas);
                    
                        //exam date
                        let examDate = ExamDates[0][0];
                        let examDateHeader = document.getElementById('examDateHeader');
                        examDateHeader.textContent += examDate;
                        
                        
                        customScheduleButton = document.getElementById('customScheduleButton');
    
                        if (usersStatus[0] === 'Irregular') {
                        customScheduleButton.style.display = 'block'; 
                        } else {
                        customScheduleButton.style.display = 'none'; 
                        }
                        // console.log('alterdata: ',alterdatas);
    
                    const tableBody = document.getElementById('tableBody');
                        let uniqueTimeSlots = [];
                    alterdatas.forEach((timeSlots) => {
                                timeSlots.Data.forEach((subject, index) => {
                                    const row = document.createElement('tr');
    
                                    if (index === 0) {
                                        const timeCell = document.createElement('td');
                                        if (!uniqueTimeSlots.includes(timeSlots.Time)) {
                                            timeCell.rowSpan = timeSlots.Data.length;
                                            timeCell.textContent = timeSlots.Time;
                                            uniqueTimeSlots.push(timeSlots.Time);
                                        }
                                        row.appendChild(timeCell);
                                    }
    
                                    // Subject
                                    const subjectCell = document.createElement('td');
                                    subjectCell.textContent = subject.Subject_name;
                                    row.appendChild(subjectCell);
    
                                    // Room
                                    const roomCell = document.createElement('td');
                                    roomCell.textContent = subject.Room;
                                    row.appendChild(roomCell);
    
                                    // Section
                                    const sectionCell = document.createElement('td');
                                    sectionCell.textContent = subject.Sections;
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
                                
                                    tableBody.appendChild(row);
                                });
                            });
            }
            else{
                
            }            
        },
        
        error: function(error) {
            console.error(error);
        }
        });
      
    }
</script>

</body>
@endsection
			
