@extends('layouts.guest')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Include Bootstrap CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Include Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/css/bootstrap.min.css"> -->

<!-- Include Bootstrap JavaScript -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.min.js"></script> -->

        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">
                    <!-- <h1 class="h3 mb-3"><strong>Customized Schedule</strong></h1> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Custom Schedule</h4>
                                </div>
                                <div class="card-body">
                                
                                <table id="newexample" class="table table-striped table-bordered table-light" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="customcheckbox">
                                                        <input type="checkbox" id="selectAll">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th> 
                                                <th>Subject</th>
                                                <th>Instructor</th>
                                                <th>Section</th>
                                                <th>code</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($subject as $index => $subjectItem)
                                            <tr>
                                                <td>
                                                    <label class="customcheckbox">
                                                        <input type="checkbox" class="selectCheckbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>{{ $subjectItem }}</td>
                                                <td>{{ isset($instructor[$index]) ? $instructor[$index] : '' }}</td>
                                                <td>{{ isset($section[$index]) ? $section[$index] : '' }}</td>
                                                <td>{{ isset($code[$index]) ? $code[$index] : '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    <button id="getSelectedDataButton" class="btn btn-primary">Get Selected Data</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Your Schedule</h4>
                                </div>
                                <div class="card-body">
                                
                                <table id="newexample1" class="table table-striped table-bordered table-light" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Instructor</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>
                                        <tbody id = "dataset">
                                        
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <br>
                                    <!-- <button id="getSelectedDataButton1" class="btn btn-primary">update schedule</button> -->
                                    <button type="button" onclick="sendSelectedDataToServer()" class="btn btn-primary">Update Schedule</button>
                                </div>
                            </div>                          
                        </div>
                    </div>
                </div>
            </main>
        </div>

<script src="{{asset('import/js/app.js')}}"></script>

<script>
    $(document).ready(function() {
        const newexample = $('#newexample').DataTable();

            // Add event listener to select/deselect all checkboxes
        $('#selectAll').on('change', function() {
            $('.selectCheckbox').prop('checked', $(this).prop('checked'));
        });
            
    });

    document.getElementById('selectAll').addEventListener('change', function () {
        // Select/deselect all checkboxes based on the state of the "Select All" checkbox
        var checkboxes = document.querySelectorAll('.selectCheckbox');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = document.getElementById('selectAll').checked;
        });
    });

    // let selectedData = [];
    // 
    document.getElementById('getSelectedDataButton').addEventListener('click', function () {

        var selectedData = [];
        var checkboxes = document.querySelectorAll('.selectCheckbox');

        
        checkboxes.forEach(function (checkbox) {
            
            if (checkbox.checked) {
                
                var row = checkbox.closest('tr');
                selectedData.push({
                    subject: row.cells[1].textContent,
                    instructor: row.cells[2].textContent,
                    section: row.cells[3].textContent,
                    code: row.cells[4].textContent
                });
            }
        });
        
        // selectedData = selectedData1;
        displaySelected(selectedData)
    });

    var SendSelected;
    function displaySelected(selectedData){
       
        const tableBody = document.getElementById('dataset');
        $('#dataset').empty();
        
        
        tableBody.innerHTML = '';

        
        selectedData.forEach(function (data) {
            var newRow = tableBody.insertRow();
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            
            cell1.textContent = data.subject;
            cell2.textContent = data.instructor;
            cell3.textContent = data.section;
            cell4.textContent = data.code;
        });
        // displaySelected(selectedData);
        SendSelected = selectedData;
        

    }
    

    function sendSelectedDataToServer() {
        console.log('display ni', SendSelected);
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            method: 'POST',
            url: '/store-selected-data',
            data: {
                selectedData: SendSelected,
                _token: csrfToken,
            },
            success: function (response) {
                window.alert("Updated Successfully");
                window.location.href = "{{ route('student.show') }}";
            },
            error: function (error) {
                console.error(error);
            },
        });
    }




</script>

</body>
@endsection
			
 