@extends('layouts.app')

@section('content')
    <div class="accordion">
        <div class="row">
            {{-- includes upload and selection form --}}
            <div class="col-12">
                @include('exams.partials.csv-selection')
            </div>

            {{-- includes upload and selection form --}}
            <div class="col-12">
                @include('exams.partials.selection-view')
            </div>

            <div class="col-12">
                @include('exams.partials.generated-exam-table')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
    <script>
        //accordion functions
        document.addEventListener("DOMContentLoaded", function() {
            const accordionItems = document.querySelectorAll(".accordion-item");

            accordionItems.forEach(item => {
                const header = item.querySelector(".accordion-header");
                const content = item.querySelector(".accordion-content");
                const arrow = item.querySelector(".accordion-arrow");

                header.addEventListener("click", () => {
                    content.style.display = content.style.display === "none" ? "block" : "none";
                    arrow.style.transform = content.style.display === "none" ? "rotate(0deg)" :
                        "rotate(180deg)";
                });
            });
        });
        //searchbar
        var searchInput = document.getElementById('searchInput');
        var tableRows = document.querySelectorAll('#subjects tbody tr');

        searchInput.addEventListener('input', function() {
            var searchText = searchInput.value.toLowerCase();

            for (var i = 0; i < tableRows.length; i++) {
                var row = tableRows[i];
                var rowData = row.innerText.toLowerCase();

                if (rowData.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        //selection
        function displaySelectedOption() {
            var periodSelect = document.getElementById('period-select');
            var selectedPeriod = periodSelect.options[periodSelect.selectedIndex].value;

            var datePicker = document.getElementById('date-picker');
            var selectedDate = datePicker.value;

            var daySelect = document.getElementById('day-select');
            var selectedDay = daySelect.value;

            var timePicker = document.getElementById('time-picker');
            var selectedTime = timePicker.value;

            var selectedText = 'Period: ' + selectedPeriod + '\n' + ' Date: ' + selectedDate + '\n' + 'Day: ' +
                selectedDay + '\n' + 'Time: ' + selectedTime;
            document.getElementById('Selected').innerText = selectedText;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('exam.fetch.subjects') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var subjects = JSON.parse(xhr.responseText);
                        displaySubjects(subjects);
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            var requestData = 'period=' + selectedPeriod;
            xhr.send(requestData);
        }
        //subject pull in csv
        function displaySubjects(subjects) {
            var table =
                '<table class="table"><thead class="thead-light"><tr><th style="vertical-align: middle;"><label class="customcheckbox"><input type="checkbox" id="mainCheckbox" onclick="selectAllSubjects()"><span class="checkmark"></span></label></th><th>Course Title</th><th>Program</th><th>Year</th><th>Serial</th></tr></thead><tbody>';

            for (var i = 0; i < subjects.length; i++) {
                var subject = subjects[i];
                table += '<tr>';
                table +=
                    '<td><label class="customcheckbox"><input type="checkbox" class="listCheckbox"><span class="checkmark"></span></label></td>';
                table += '<td>' + subject.course_title + '</td>';
                table += '<td>' + subject.program + '</td>';
                table += '<td>' + subject.year + '</td>';
                table += '<td>' + subject.serial + '</td>';
                table += '</tr>';
            }

            table += '</tbody></table>';
            document.getElementById('subjects').innerHTML = table;

            // Update the tableRows variable with the new table rows
            tableRows = document.querySelectorAll('#subjects tbody tr');
        }

        function selectAllSubjects() {
            var checkboxes = document.getElementsByClassName('listCheckbox');
            var mainCheckbox = document.getElementById('mainCheckbox');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = mainCheckbox.checked;
            }
        }
        //global var for sub and prog
        var SubjectsProgram = [];
        function addSubjects() {
            var container = document.getElementById('subjects');
            var selectedSubjects = [];
            container.addEventListener('click', function(event) {
                var target = event.target;
                if (target.classList.contains('listCheckbox')) {
                    var row = target.closest('tr');
                    var cells = row.cells;
                    var subject = {
                        subject: cells[1].textContent,
                        program: cells[2].textContent,
                        year: cells[3].textContent,
                        serial: cells[4].textContent,
                    };
                    if (target.checked) {
                        selectedSubjects.push(subject);
                    } else {

                        var index = selectedSubjects.findIndex(function(item) {
                            return (
                                item.subject === subject.subject &&
                                item.program === subject.program &&
                                item.year === subject.year &&
                                item.serial === subject.serial
                            );
                        });

                        if (index !== -1) {
                            selectedSubjects.splice(index, 1);
                        }
                    }
                    SubjectsProgram.push({
                    SubjectName: subject.subject,
                    Program: subject.program
                    });
                    
                    //console.log(subjectsArray1);

                    fetchAdditionalInfo(selectedSubjects);
                    displayfromgentable(selectedSubjects);

                }
            });
        }
        //additional Info
        function fetchAdditionalInfo(selectedSubjects) {
            // Create an array to store the selected subject names
            var selectedSubjectNames = selectedSubjects.map(function(subject) {
                return subject.subject;
            });

            // Send a request to fetch additional information
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('exam.fetch.additionalInfo') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var additionalInfo = JSON.parse(xhr.responseText);
                        
                        displaySubjectsAndAdditionalInfo(selectedSubjects, additionalInfo);
                    } else {
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            
            xhr.send(JSON.stringify(selectedSubjectNames));
        }


        
        
        function displaySubjectsAndAdditionalInfo(selectedSubjects, additionalInfo) {
            var subroomDiv = document.getElementById('Sub');
            var ul = document.createElement('ul');
            ul.className = 'subject-grid';

            // Clear the existing content of subjectsArray
            subjectsArray = [];

            for (var i = 0; i < selectedSubjects.length; i++) {
                var subject = selectedSubjects[i];
                var li = document.createElement('li');
                li.className = 'subject-item';
                li.innerHTML =
                    '<strong>Course Title:</strong> ' +
                    subject.subject +
                    '<br><strong>Program:</strong> ' +
                    subject.program +
                    '<br><strong>Year:</strong> ' +
                    subject.year +
                    '<br><strong>Serial:</strong>' +
                    subject.serial;

                    

                // Check if additionalInfo is available and has info for this subject
                if (additionalInfo && additionalInfo[subject.subject]) {
                    var info = additionalInfo[subject.subject];
                    li.innerHTML += info; // Append the additional information
                    
                    // console.log('subject.program', subprog);
                    // Add the information to the array
                    subjectsArray.push({
                        subject: subject.subject,
                        program: subject.program,
                        year: subject.year,
                        serial: subject.serial,
                        additionalInfo: info,
                    });

                }

                ul.appendChild(li);
            }
            //console.log('new', subjectsArray);
            
            subroomDiv.innerHTML = '';
            subroomDiv.appendChild(ul);
        }

        // Call the addSubjects() function when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            addSubjects();
        });

        // Add an event listener to all checkboxes with the class 'listCheckbox1'
        var checkboxes = document.getElementsByClassName('listCheckbox1');
        for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function() {
            addRooms(); // Trigger addRooms when a checkbox is checked or unchecked
        });
        }
        //Rooms pull
        //global var for rooms
        var GlobalRooms = [];
        function addRooms() {
            var checkboxes = document.getElementsByClassName('listCheckbox1');
            var selectedRooms = [];
            GlobalRooms = selectedRooms;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                var parent = checkboxes[i].closest('.room-item'); 
                if (parent) {
                    var roomNameElement = parent.querySelector('.room-name'); 
                    if (roomNameElement) {
                    var roomName = roomNameElement.textContent;
                    selectedRooms.push(roomName);
                    } else {
                    console.log('No room name element found.');
                    }
                } else {
                    console.log('No parent element found.');
                }
                }
            }

                if (selectedRooms.length > 0) {
                    var roomDiv = document.getElementById('room');
                    var roomsList = document.createElement('ul');

                    for (var j = 0; j < selectedRooms.length; j++) {
                    var roomItem = document.createElement('li');
                    roomItem.textContent = selectedRooms[j];
                    roomsList.appendChild(roomItem);
                    }

                    roomDiv.innerHTML = ''; 
                    roomDiv.appendChild(roomsList);
                    
                    return(selectedRooms);
                    
                }    
              
        }

        //timeFunction
        //global var for time
        var GlobalTime;
        function addExaminationPeriod() {
    
            var timePeriods = [];
            GlobalTime = timePeriods;

            var timePicker = document.getElementById('time-picker');
            var selectedTime = timePicker.value;

            var startTime = new Date();
            var [startHours, startMinutes] = selectedTime.split(':').map(Number);
            startTime.setHours(startHours, startMinutes, 0);

            //end time
            var endTime = new Date();
            endTime.setHours(19, 0, 0);

            var interval = 75; 

            
            var table = document.getElementById('gentab');

            table.innerHTML = '';
            

            while (startTime <= endTime && getEndTime(startTime, interval) <= endTime) {
                // Check if the current start time is 12:00 PM
                if (startTime.getHours() >= 12 && startTime.getMinutes() <= 59) {
                    // Add the 30-minute break
                    var breakEndTime = new Date(startTime.getTime() + 30 * 60000);
                    var breakTimePeriod = formatTime(startTime) + ' - ' + formatTime(breakEndTime);
                    //timePeriods.push(breakTimePeriod);
                    
                    // Update the startTime to be the end of the break
                    startTime = breakEndTime;
                    
                }
                
                var newTable = document.createElement('table');
                newTable.className = 'table';

                var thead = document.createElement('thead');
                thead.innerHTML = `
                    <tr>
                        <th id="time"></th>
                        <th scope="col" id="code">no data</th>
                        <th scope="col" id="subject">no data</th>
                    </tr>
                    <tr>
                        <th scope="col">SECTION</th>
                        <th scope="col">CLASS #</th>
                        <th scope="col">ROOM</th>
                        <th scope="col">INSTRUCTOR</th>
                        <th scope="col"># OF STUDENTS</th>
                    </tr>
                `;

                var tbody = document.createElement('tbody');
                var tbodyRow = document.createElement('tr');
                var timePeriod = formatTime(startTime) + ' - ' + formatTime(getEndTime(startTime, interval));
                timePeriods.push(timePeriod); // Push the time period string to the array
                tbodyRow.innerHTML = `
                    <td headers="time">${timePeriod}</td>
                `;
                tbody.appendChild(tbodyRow);

                newTable.appendChild(thead);
                newTable.appendChild(tbody);

                table.appendChild(newTable);



                startTime = new Date(startTime.getTime() + interval * 60000);
            }

            function formatTime(time) {
                var hours = time.getHours();
                var minutes = time.getMinutes();
                var amPm = hours >= 12 ? 'PM' : 'AM';
                hours %= 12;
                hours = hours ? hours : 12; // Convert 0 to 12
                minutes = minutes < 10 ? '0' + minutes : minutes;
                return hours + ':' + minutes + ' ' + amPm;
            }

            function getEndTime(startTime, interval) {
                return new Date(startTime.getTime() + interval * 60000);
            }
            //console.log(timePeriods);
            
        }

        //global var
        var Sections = [];
        var ClassNumbers = [];
        var Instructors = [];
        var StudentCount = [];
        var selectedSubjectNames1;

        function displayfromgentable(selectedSubjects) {
            selectedSubjectNames1 = selectedSubjects.map(function(subject) {
                return subject.subject;
            });
            

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route('displaygentab') }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText); 

                    
                    selectedSubjectNames1.forEach(function(subjectName) {
                    Sections[subjectName] = [];
                    ClassNumbers[subjectName] = [];
                    Instructors[subjectName] = [];
                    StudentCount[subjectName] = [];
                    });
                   
             
                    
                    Object.keys(response.sections).forEach(function(subjectName) {
                    if (selectedSubjectNames1.includes(subjectName)) {
                        Sections[subjectName] = response.sections[subjectName];
                        ClassNumbers[subjectName] = response.classNumbers[subjectName];
                        Instructors[subjectName] = response.instructors[subjectName];
                        StudentCount[subjectName] = response.numOfStudents[subjectName];
                    }
                    });
                    

                    
                    //console.log('Sections:', Sections);
                    //console.log('Class Numbers:', ClassNumbers);
                    // console.log('Instructors:', Instructors);
                    // console.log('Student Count:', StudentCount);
                } else {
                    console.error('Error: ' + xhr.status);
                }
                }
            };

            xhr.send(JSON.stringify(selectedSubjectNames1));
            //console.log(selectedSubjectNames1);
        }
        function shuffleArray(array) {
        // Function to shuffle an array randomly
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        function generateExam() {

            const maxRoomCapacity = 50;
            const maxSubjectInsert = 20;
            var timeSlotRooms = [];
            var SubProperty = [];
            var ClassNumbersArray = [];
            

            for (var subjectName in Sections) {
                if (Sections.hasOwnProperty(subjectName)) {
                    var sectionData = Sections[subjectName];
                    var ClassNumbersData = ClassNumbers[subjectName];
                    var InstructorsData = Instructors[subjectName];
                    var StudentCountData = StudentCount[subjectName].map(Number);//str to int 
                  
                    SubProperty.push({
                        subjectName: subjectName,
                        sectionData: sectionData,
                        ClassNumbers:  ClassNumbersData, 
                        Instructors: InstructorsData,   
                        StudentCount: StudentCountData 
                    });
                    console.log(subjectName);
                    
                }
            }
            console.log('Subject Property',SubProperty);
            

            for (var i = 0; i < GlobalTime.length; i++) {
                var timePeriod = GlobalTime[i];
                var timeSlot = {
                    timeSlot: timePeriod,
                    rooms: GlobalRooms 
                };
                timeSlotRooms.push(timeSlot);
            }

            console.log('TimeSlots with Rooms', timeSlotRooms);

            //filtering rooms in every timeslot
            var examSchedule = [];
            var allRoomsUsed = false;
            

            for (var i = 0; i < timeSlotRooms.length; i++) {
                var timeSlot = timeSlotRooms[i];

                
                var subjectsForTimeSlot = [];
                var UsedRooms = [];
                var availableRooms = [...timeSlot.rooms];

                // Iterate through each subject
                for (var j = 0; j < SubProperty.length; j++) {
                    var subject = SubProperty[j];
                    
                    var sectionData = subject.sectionData;
                    
                    if (Array.isArray(timeSlot.rooms) && sectionData.length <= availableRooms.length) {
                        
                        subjectsForTimeSlot.push(subject);
                        SubProperty.splice(j, 1);

                        
                        UsedRooms.push(availableRooms.splice(0, sectionData.length));
                        
                        j--;
                    }
                }

                examSchedule.push({
                    time: timeSlot.timeSlot,
                    subjects: subjectsForTimeSlot,
                    room: UsedRooms,
                    //combined: combinedData
                });
               
                if (SubProperty.length === 0) {
                    allRoomsUsed = true;
                    break;
                }
            }

            if (!allRoomsUsed) {
                alert('Some subjects could not be inserted due to insufficient rooms in all time slots.');
            }
            console.log('Generated Exam Schedule:', examSchedule);

            //merging Section
           
            
            var sortSchedule = JSON.parse(JSON.stringify(examSchedule));
            sortSchedule.forEach((timeSlot) => {
                var mergedData = [];
                var currentMergedStudentCount = 0;
                var currentMergedSectionData = [];
                var currentMergedInstructors = [];
                var currentMergedClassNumbers = [];

                timeSlot.subjects.forEach((subject) => {
                    subject.StudentCount.sort((a, b) => a - b);
                    //console.log('check',subject.StudentCount);
                    var SubwithProg = [...SubjectsProgram];
                    if (subject.StudentCount) {
                        subject.StudentCount.forEach((count, index) => {
                            currentMergedStudentCount += count;
                                currentMergedSectionData.push(subject.sectionData[index].trim());
                                currentMergedInstructors.push(subject.Instructors[index].trim());
                                currentMergedClassNumbers.push(subject.ClassNumbers[index].trim());
                            
                            if (currentMergedStudentCount + count >= 50) {
                                
                                    // Push the current merged data to the mergedData array
                                mergedData.push({
                                    Subject: SubwithProg,
                                    StudentCount: currentMergedStudentCount,
                                    SectionData: currentMergedSectionData.join(', '),
                                    ClassCode: currentMergedClassNumbers.join(', '),
                                    Instructors: currentMergedInstructors.join(', '), // Join the SectionData with a comma
                                });

                                //     // Reset counters
                                currentMergedStudentCount = 0;
                                currentMergedSectionData = [];
                                currentMergedInstructors = [];
                                currentMergedClassNumbers = [];
                            }
                             
                        });
                    }
                });
                if (currentMergedSectionData.length > 0) {
                    mergedData.push({
                        StudentCount: currentMergedStudentCount,
                        SectionData: currentMergedSectionData.join(', '),
                        ClassCode: currentMergedClassNumbers.join(', '),
                        Instructors: currentMergedInstructors.join(', '), // Join the Instructors with a comma
                    });
                }

                timeSlot.subject = mergedData;
            });

            console.log('Merged Data:', sortSchedule);


        }

        
    </script>
@endsection