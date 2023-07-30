@extends('layouts.app')


@section('content')
<div class="container-fluid">

  <form class="app-search">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Search &amp; enter">
      <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
    </div>
      
  </form>
  
  <form action="{-- route('upload.csv') --}" method="post" enctype="multipart/form-data" onsubmit="showSuccessMessage()">
      @csrf
      <div class="mb-3 form-group">
          <label for="matrix" class="form-label">Upload Matrix</label>
          <input type="file" class="form-control-file" id="matrix" name="matrix" accept=".csv">
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Upload</button>
  </form>
  
  <form action="{-- route('upload.classlist') --}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
          <label for="classsec" class="form-label">Upload Class list by Section</label>
          <input type="file" class="form-control-file" id="classsec" name="Class_List" accept=".csv">
      </div>
      <button type="submit" class="btn btn-primary btn-sm">Upload</button>
  </form>
</div>

@endsection

@section('script')
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

  var selectedText = 'Period: ' + selectedPeriod + '\n'+' Date: ' + selectedDate + '\n'+ 'Day: ' + selectedDay + '\n'+ 'Time: ' + selectedTime;
  document.getElementById('Selected').innerText = selectedText;

  // Make an AJAX request to fetch the data from the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '/createschedule/generateschedule?fetch=' + selectedPeriod, true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var subjects = JSON.parse(xhr.responseText);
        console.log(subjects); // Check if the parsed data is as expected
        displaySubjects(subjects);
      } else {
        console.error('Error: ' + xhr.status);
      }
    }
  };
  xhr.send();
}


function displaySubjects(subjects) {
  var table = '<table class="table"><thead class="thead-light"><tr><th style="vertical-align: middle;"><label class="customcheckbox"><input type="checkbox" id="mainCheckbox" onclick="selectAllSubjects()"><span class="checkmark"></span></label></th><th>Course Title</th><th>Program</th><th>Year</th><th>Serial</th></tr></thead><tbody>';

  for (var i = 0; i < subjects.length; i++) {
    var subject = subjects[i];
    table += '<tr>';
    table += '<td><label class="customcheckbox"><input type="checkbox" class="listCheckbox"><span class="checkmark"></span></label></td>';
    table += '<td>' + subject.subject + '</td>';
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
  var checkboxes = document.getElementsByClassName('listCheckbox');
  var selectedSubjects = [];

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      var row = checkboxes[i].closest('tr'); // Get the closest parent <tr> element
      var cells = row.cells; // Access the cells of the row
      var subject = {
        subject: cells[1].textContent,
        program: cells[2].textContent,
        year: cells[3].textContent,
        serial: cells[4].textContent
      };
      selectedSubjects.push(subject);
    }
  }

  if (selectedSubjects.length > 0) {
    var subroomDiv = document.getElementById('Sub');
    var table = document.createElement('table');
    table.className = 'table';
    var thead = document.createElement('thead');
    var tr = document.createElement('tr');
    tr.innerHTML = '<th>Course Title</th><th>Program</th><th>Year</th><th>Serial</th><th>CLASS #</th><th>SECTION</th> <th>INSTRUCTOR</th><th># OF STUDENTS</th>';
    thead.appendChild(tr);
    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    
    for (var j = 0; j < selectedSubjects.length; j++) {
      var subject = selectedSubjects[j];
      var row = document.createElement('tr');
      row.innerHTML = '<td>' + subject.subject + '</td><td>' + subject.program + '</td><td>' + subject.year + '</td><td>' + subject.serial + '</td><td id="section">no data</td><td id="classnum">no data</td><td id="instructor">no data</td><td id="numstudent">no data</td>';
      tbody.appendChild(row);
    }

    table.appendChild(tbody);

    // Clear the existing content of Subroom before adding the updated table
    subroomDiv.innerHTML = '';
    subroomDiv.appendChild(table);
  }
}


</script>

<script>
function addRooms() {
  var checkboxes = document.getElementsByClassName('listCheckbox1');
  var selectedRooms = [];

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      var room = checkboxes[i].parentNode.parentNode.nextElementSibling.textContent;
      selectedRooms.push(room);
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
function addAllSelected() {
  var selectedSubjects = document.querySelectorAll('#subjects .listCheckbox:checked');

  // Get the table element
  var table = document.getElementById('gentab');

  // Clear any existing content
  table.innerHTML = '';

  // Create the table structure for each selected subject
  selectedSubjects.forEach(function (subject) {
    var subjectName = subject.parentNode.parentNode.nextElementSibling.textContent;

    // Create the table header
    var thead = document.createElement('thead');
    thead.innerHTML = `
      <tr>
        <th scope="col" id="time" rowspan="3">Time</th>
        <th scope="col" id="code">no data</th>
        <th scope="col" id="subject">${subjectName}</th>
      </tr>
      <tr>
        <th scope="col">SECTION</th>
        <th scope="col">CLASS #</th>
        <th scope="col">ROOM</th>
        <th scope="col">INSTRUCTOR</th>
        <th scope="col"># OF STUDENTS</th>
      </tr>
    `;

    // Create the table body
    var tbody = document.createElement('tbody');
    var tbodyRow = document.createElement('tr');
    tbodyRow.innerHTML = 
    `
      <td headers="time"> No data</td>
      <td id="section">no data</td>
      <td id="classnum">no data</td>
      <td id="room">no data</td>
      <td id="instructor">no data</td>
      <td id="numstudent">no data</td>
    `;
    tbody.appendChild(tbodyRow);

    // Append the table header and body to the table
    table.appendChild(thead);
    table.appendChild(tbody);
  });
}
</script>
<script>
function addExaminationPeriod() {
  var timePicker = document.getElementById('time-picker');
  var selectedTime = timePicker.value;

  // Create a Date object to parse the selected time
  var startTime = new Date();
  var [startHours, startMinutes] = selectedTime.split(':').map(Number);
  startTime.setHours(startHours, startMinutes, 0);

  // Set the ending time to 5:00 PM
  var endTime = new Date();
  endTime.setHours(17, 0, 0);

  // Create a variable to store the time interval
  var interval = 75; // 1 hour and 15 minutes in minutes

  // Get the table element
  var table = document.getElementById('gentab');

  // Clear any existing content
  table.innerHTML = '';

  // Loop through the time intervals and create tables for each
  while (startTime <= endTime && getEndTime(startTime, interval) <= endTime) {
    // Create a new table
    var newTable = document.createElement('table');
    newTable.className = 'table';

    // Create the table header
    var thead = document.createElement('thead');
    thead.innerHTML = `
      <tr>
        <th scope="col" id="time" rowspan="3"></th>
      </tr>
      <tr>
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

    // Create the table body
    var tbody = document.createElement('tbody');
    var tbodyRow = document.createElement('tr');
    tbodyRow.innerHTML = `
      <td headers="time">${formatTime(startTime)} - ${formatTime(getEndTime(startTime, interval))}</td>

    `;
    tbody.appendChild(tbodyRow);

    // Append the table header and body to the table
    newTable.appendChild(thead);
    newTable.appendChild(tbody);

    // Append the new table to the main table
    table.appendChild(newTable);

    // Increment the start time by the interval
    startTime = new Date(startTime.getTime() + interval * 60000);
  }
}

// Helper function to format time in HH:MM AM/PM format
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