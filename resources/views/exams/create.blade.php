@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">Upload Schedule</h2>
          <form method="post" action="{{ route('upload.csv') }}" enctype="multipart/form-data">
              @csrf
              <br>
              <br>
              <div class="mb-3 form-group">
                  <label for="matrix" class="form-label">Upload Matrix</label>
                  <input type="file" class="form-control-file" id="matrix" name="matrix" accept=".csv">
              </div>
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </form>


        </div>
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
              <table class="table" id="t2">
                <thead class="thead-light">
                  <tr>
                    <th>
                      <label class="customcheckbox mb-0">
                        <input type="checkbox" id="mainCheckbox1" onclick="selectAllRooms()">
                        <span class="checkmark"></span>

                      </label>
                    </th>
                    <th scope="col">Rooms Available</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($rooms as $room)
                  <tr>
                    <th>
                      <label class="customcheckbox">
                        <input type="checkbox" class="listCheckbox1">
                        <span class="checkmark"></span>
                      </label>
                    </th>
                    <td>{{ $room->room_name }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <button type="submit" class="btn btn-success text-white" onclick="addRooms()">Add Rooms</button>

            </div>
          </div>
        </div>
      </div>
    </div>
    
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">You Selected</h3>
            <br>
            <br>
            <div class="bd-example" id="Selected">

              <!-- /btn-group -->

            </div>

          </div>

          <div class="border-top">
            <div class="card-body">
              <h3 class="card-title">Subjects</h3>
              <br>
              <div class="bd-example" id="Sub">
                <!-- /btn-group -->
              </div>
              <button type="submit" class="btn btn-success text-white">Fetch</button>
            </div>
          </div>

          <div class="border-top">
            <div class="card-body">
              <h3 class="card-title">Rooms</h3>
              <br>
              <div class="bd-example" id="room">
                <!-- /btn-group -->
              </div>
              <button type="submit" class="btn btn-primary text-white" onclick="addAllSelected()">Add All Selected</button>
              <button type="submit" class="btn btn-success text-white" onclick="addExaminationPeriod()">Add Time</button>



            </div>

          </div>

        </div>

      </div>
    



  </div>
</div>

@endsection

@section('scripts')

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


@endsection