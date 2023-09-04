@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="accordion">
  <div class="row">
    <div class="col-12">
      <div class="card">
      <div class="accordion-item">
        <div class="card-body">
        <div class="accordion-header">Upload CSV and Selections
        <i class="accordion-arrow fas fa-chevron-down"></i>
        </div>
        <div class="accordion-content">
          <form method="post" action="{{ route('upload.csv') }}" enctype="multipart/form-data">
              @csrf
              <br>
              <br>
              <div class="mb-3 form-group">
                  <label for="matrix" class="form-label">Upload Matrix</label>
                  <input type="file" class="form-control-file" id="matrix" name="matrix" accept=".csv">
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
              <br>
              <br>
          </form>


        
        <div class="border-top">
          <div class="card-body">
            <h3 class="card-title">Selection</h3>
            <br>
            <div class="mb-3 d-flex align-items-center">
              <label for="period-select" class="me-2 mb-0">Select Period: </label>
              <select name="period-select" id="period-select" class="mr-3 ml-1">
                  <option value="-Select Period-">-Select Period-</option>
                  <option value="Prelim">Prelims</option>
                  <option value="Midterm">Midterms</option>
                  <option value="Pre-Final">Pre-Finals</option>
                  <option value="Finals">Finals</option>
              </select>

              <label for="date-picker" class="me-2 mb-0">Date of Exam: </label>
              <input type="date" name="date-picker" id="date-picker" class="mr-3 ml-1">

              <label for="day-select" class="me-2 mb-0">Select Day:</label>
              <select name="day-select" id="day-select" class="mr-3 ml-1">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
              <label for="time-picker" class="me-3 mb-0">Exam Starting Time: </label>
              <input type="time" name="time-picker" id="time-picker" class ="ml-1">
            </div>
            <button type="button" class="btn btn-success text-white" onclick="displaySelectedOption()">Add</button>
            <div id="csvData"></div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <h3 class="card-title">Selection of Subjects</h3>
              <br>
              <br>
              <div>
                <input type="text" id="searchInput" placeholder="Search">
                <br>
                <br>
                <table class="table" id="subjects">
                  <thead class="thead-light">
                    <tr>
                      <th>
                        <label class="customcheckbox mb-0">
                          <input type="checkbox" id="mainCheckbox">
                          <span class="checkmark"></span>
                        </label>
                      </th>
                      <th scope="col">Course Title</th>
                      <th scope="col">Program</th>
                      <th scope="col">Year</th>
                      <th scope="col">Serial</th>

                    </tr>
                  </thead>

                  <tbody class="customtable">
                    <tr>
                      <th>
                        <label class="customcheckbox">
                          <input type="checkbox" class="listCheckbox">
                          <span class="checkmark"></span>
                        </label>
                      </th>
                      <td>no data</td>
                      <td>no data</td>
                      <td>no data</td>
                      <td>no data</td>
                    </tr>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-success text-white" onclick="addSubjects()">Add Subjects</button>
              </div>

            </div>
          </div>
          <div class="border-top">
            <div class="card-body">
              <h3 class="card-title">Selection of Rooms</h3>
              <br>
              <br>
              <ul class="room-list">
                @foreach($rooms as $room)
                <li class="room-item">
                  <label class="customcheckbox">
                    <input type="checkbox" class="listCheckbox1">
                    <span class="checkmark"></span>
                  </label>
                  
                  <span class="room-name">{{ $room->room_name }}</span>
                </li>
                @endforeach
              </ul>
              <br>

              <button type="submit" class="btn btn-success text-white" onclick="addRooms()">Add Rooms</button>

            </div>
          </div>
        </div>
        </div>
        </div>
      </div>
     </div>
    </div>
    
      <div class="col-12">
        <div class="card">
        <div class="accordion-item">
          <div class="card-body">
          <div class="accordion-header">View Selections
        <i class="accordion-arrow fas fa-chevron-down"></i>
        </div>
        <div class="accordion-content">
            <div class="bd-example" id="Selected">

              

            </div>

          

          <div class="border-top">
            <div class="card-body" >
              <h3 class="card-title">Subjects</h3>
              <br>
              <br>
              <div class="bd-example" id="Sub">
                <p>
                  <strong>No Data selected </strong>
                </p>

              </div>
            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <h3 class="card-title">Rooms</h3>
              <br>
              <br>
                <br>
              <div class="bd-example" id="room">

                 <p>
                  <strong>No Data selected </strong>
                </p>
              </div>
              <button type="submit" class="btn btn-primary text-white" onclick="addAllSelected()">Add All Selected</button>
              <button type="submit" class="btn btn-success text-white" onclick="addExaminationPeriod()">Add Time</button>



            </div>

          </div>

        </div>
        </div>
        </div>
      </div>
      
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Generate Exam Table</h3>
                  <div class="bd-example" id = "gentable">
                  <table class="table" id="gentab">
                <thead>
                  <tr>
                    <th colspan="5" id="time" >no data</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td id="code">no data</td>
                    <td colspan="4" id="subject">no data</td>
                  </tr>
                  <tr>
                    <th >SECTION</th>
                    <th >CLASS #</th>
                    <th >ROOM</th>
                    <th >INSTRUCTOR</th>
                    <th ># OF STUDENTS</th>
                  </tr>
                  <tr>
                    
                    <td  id="section">no data</td>
                    <td  id="classnum">no data</td>
                    <td  id="room">no data</td>
                    <td  id="instructor">no data</td>
                    <td  id="numstudent">no data</td>
                  </tr>
                </tbody>
                </table>

                  </div>
                </div>
              </div>
            </div>
  
  </div>

    



  </div>
</div>
</div>
@endsection

@section('scripts')
<!--for accordion script drop and down contents-->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach(item => {
      const header = item.querySelector(".accordion-header");
      const content = item.querySelector(".accordion-content");
      const arrow = item.querySelector(".accordion-arrow");

      header.addEventListener("click", () => {
        content.style.display = content.style.display === "none" ? "block" : "none";
        arrow.style.transform = content.style.display === "none" ? "rotate(0deg)" : "rotate(180deg)";
      });
    });
  });
</script>

<script>
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

  function displaySelectedOption() {
    var periodSelect = document.getElementById('period-select');
    var selectedPeriod = periodSelect.options[periodSelect.selectedIndex].value;

    var datePicker = document.getElementById('date-picker');
    var selectedDate = datePicker.value;

    var daySelect = document.getElementById('day-select');
    var selectedDay = daySelect.value;

    var timePicker = document.getElementById('time-picker');
    var selectedTime = timePicker.value;

    var selectedText = 'Period: ' + selectedPeriod + '\n' + ' Date: ' + selectedDate + '\n' + 'Day: ' + selectedDay + '\n' + 'Time: ' + selectedTime;
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


  function displaySubjects(subjects) {
    var table = '<table class="table"><thead class="thead-light"><tr><th style="vertical-align: middle;"><label class="customcheckbox"><input type="checkbox" id="mainCheckbox" onclick="selectAllSubjects()"><span class="checkmark"></span></label></th><th>Course Title</th><th>Program</th><th>Year</th><th>Serial</th></tr></thead><tbody>';

    for (var i = 0; i < subjects.length; i++) {
      var subject = subjects[i];
      table += '<tr>';
      table += '<td><label class="customcheckbox"><input type="checkbox" class="listCheckbox"><span class="checkmark"></span></label></td>';
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
</script>




<script>
function addSubjects() {
  // Get the container element (the parent of all checkboxes)
  var container = document.getElementById('subjects');

  // Initialize an array to store selected subjects
  var selectedSubjects = [];

  // Add a click event listener to the container (event delegation)
  container.addEventListener('click', function(event) {
    var target = event.target;

    // Check if the clicked element is a checkbox
    if (target.classList.contains('listCheckbox')) {
      // Get the closest row (parent TR)
      var row = target.closest('tr');

      // Extract data from the row's cells
      var cells = row.cells;
      var subject = {
        subject: cells[1].textContent,
        program: cells[2].textContent,
        year: cells[3].textContent,
        serial: cells[4].textContent,
      };

      // Toggle selection (add/remove from array) based on checkbox state
      if (target.checked) {
        selectedSubjects.push(subject);
      } else {
        // Remove the subject from the array if the checkbox is unchecked
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

      // Update the UI to display selected subjects
      displaySelectedSubjects(selectedSubjects);

      // Call the fetchAdditionalInfo function when there's a change
      fetchAdditionalInfo(selectedSubjects);
    }
  });

  // Rest of your addSubjects() function...
}

// Call the addSubjects() function when the page loads
document.addEventListener('DOMContentLoaded', function() {
  addSubjects();
});

</script>



<script>
  function fetchAdditionalInfo(selectedSubjects) {
  // Create an array to store the selected subject names
  var selectedSubjectNames = selectedSubjects.map(function (subject) {
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
        // Display selected subjects
        displaySelectedSubjects(selectedSubjects);
        // Display additional info
        displayAdditionalInfo(additionalInfo, selectedSubjects);
      } else {
        
      }
      console.log(xhr.responseText);
    }
  };

  // Send the selected subject names as JSON data
  xhr.send(JSON.stringify(selectedSubjectNames));
}

function displaySelectedSubjects(selectedSubjects) {
  var subroomDiv = document.getElementById('Sub');
  var ul = document.createElement('ul');
  ul.className = 'subject-grid';

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
      '<br><strong>Serial:</strong> ' +
      subject.serial;
    ul.appendChild(li);
  }

  // Clear the existing content of Subroom before adding the updated list
  subroomDiv.innerHTML = '';
  subroomDiv.appendChild(ul);
}

function displayAdditionalInfo(additionalInfo, selectedSubjects) {
  // Assuming additionalInfo is an object with subject names as keys
  var subroomDiv = document.getElementById('Sub');

  for (var i = 0; i < selectedSubjects.length; i++) {
    var subject = selectedSubjects[i];
    var info = additionalInfo[subject.subject];

    // Check if info exists for the selected subject
    if (info) {
      var li = document.createElement('li');
      li.className = 'additional-info';
      li.innerHTML =
        '<strong>Section:</strong> ' + info['Section'] +
        '<br><strong>CLASS #:</strong> ' + info['CLASS #'] +
        '<br><strong>Instructor:</strong> ' + info['Instructor'] +
        '<br><strong># of students:</strong> ' + info['# of students'];
      subroomDiv.appendChild(li);
    }
  }
}

</script>


<script>
  function addRooms() {
  var checkboxes = document.getElementsByClassName('listCheckbox1');
  var selectedRooms = [];

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      var parent = checkboxes[i].closest('.room-item'); // Check the closest parent with the class 'room-item'
      if (parent) {
        var roomNameElement = parent.querySelector('.room-name'); // Get the element with class 'room-name'
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

    roomDiv.innerHTML = ''; // Clear any existing content
    roomDiv.appendChild(roomsList);
  }
}

</script>
<script>
function addExaminationPeriod() {
  var timePicker = document.getElementById('time-picker');
  var selectedTime = timePicker.value;

  
  var startTime = new Date();
  var [startHours, startMinutes] = selectedTime.split(':').map(Number);
  startTime.setHours(startHours, startMinutes, 0);

  // ending time alas 5pm
  var endTime = new Date();
  endTime.setHours(17, 0, 0);

 
  var interval = 75; // 1 hour and 15 minutes in minutes

  // display in table named gentab
  var table = document.getElementById('gentab');

  
  table.innerHTML = '';

  
  while (startTime <= endTime && getEndTime(startTime, interval) <= endTime) {
    
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
    tbodyRow.innerHTML = `
      <td headers="time">${formatTime(startTime)} - ${formatTime(getEndTime(startTime, interval))}</td>

    `;
    tbody.appendChild(tbodyRow);

    
    newTable.appendChild(thead);
    newTable.appendChild(tbody);

    
    table.appendChild(newTable);

    
    startTime = new Date(startTime.getTime() + interval * 60000);
  }
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

// Helper function to get the end time based on the start time and interval
function getEndTime(startTime, interval) {
  return new Date(startTime.getTime() + interval * 60000);
}
</script>


@endsection