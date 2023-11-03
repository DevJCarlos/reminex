@extends('layouts.app')
<head>
    
</head>


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
                                        <option value="option1_1">Prelims</option>
                                        <option value="option1_2">Midterms</option>
                                        <option value="option1_3">Pre-Finals</option>
                                        <option value="option1_3">Finals</option>
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
                                        <option value="option2_1">Day 1</option>
                                        <option value="option2_2">Day 2</option>
                                        <option value="option2_3">Day 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    <button type="submit" class="btn btn-success">Excel</button>
                </div>
                <div class="card-body">
                    <table class = "table table-bordered">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Subject</th>
                                <th>Rooms</th>
                                <th>Section</th>
                                <th>Section Number</th>
                                <th>Instructor</th>
                                <th>Student Count</th>
                                <th>Proctors</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examDays as $examDay)
                                @foreach ($examDay->examTime as $examTime)
                                    @php
                                        $examSub = $examTime->examSub;
                                    @endphp
                                    <tr>
                                        <td rowspan="{{ count($examSub) }}">{{ $examTime->exam_time }}</td>
                                        <td>{{ count($examSub) > 0 ? $examSub[0]->subject_name : 'NO DATA CREATED' }}</td>
                                    </tr>
                                    @for ($i = 1; $i < count($examSub); $i++)
                                        <tr>
                                            <td>{{ $examSub[$i]->subject_name }}</td>
                                        </tr>
                                    @endfor
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-success" style="width: 150px;">Release To Teachers</button>
                    <button type="submit" class="btn btn-success" style="width: 150px;">Release To Students</button>
                    
                </div>
                
            </div> 
        </div>
    </div>
<!-- </div> -->


@endsection

@section('scripts')

<script>
    var accordionButtons = document.querySelectorAll('.accordion-button');

    // Add click event listeners to each button
    accordionButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Toggle the next sibling element (the content section)
            var content = this.nextElementSibling;
            if (content.style.display === 'block') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        });
    });

    $(document).ready(function() {
    $('#Prelims').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'Data export'
            },
            {
                extend: 'pdfHtml5',
                title: 'Data export'
            }
        ]
    } );
} );

</script>
@endsection