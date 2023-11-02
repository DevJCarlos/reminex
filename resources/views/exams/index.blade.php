@extends('layouts.app')
<head>
    
</head>


@section('content')
<div class="accordion">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="accordion-item">
                    <div class="card-body">
                        <div class="accordion-header">Prelims Exam Table
                            <i class="accordion-arrow fas fa-chevron-down"></i>
                        </div>
                            <div class="accordion-content">
                                <div class="container"> 
                                    <table id="Prelims" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Subject</th>
                                                <th>Rooms</th>
                                                <th>Section</th>
                                                <th>Class Number</th>
                                                <th>Instructor</th>
                                                <th>Student Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>no data</th>
                                            <th>no data</th>
                                            <th>no data</th>
                                            <th>no data</th>
                                            <th>no data</th>
                                            <th>no data</th>
                                            <th>no data</th>
                                        </tr>
                                        </tbody>
                                    </table>
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
                        <div class="accordion-header">Midterms Exam Table
                            <i class="accordion-arrow fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                        <table class="table table-bordered" width="100%" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Class Number</th>
                                    <th>Instructor</th>
                                    <th>Student Count</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="accordion-item">
                    <div class="card-body">
                        <div class="accordion-header">Pre-Finals Exam Table
                            <i class="accordion-arrow fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                        <table class="table table-bordered" width="100%" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Class Number</th>
                                    <th>Instructor</th>
                                    <th>Student Count</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="accordion-item">
                    <div class="card-body">
                        <div class="accordion-header">Finals Exam Table
                            <i class="accordion-arrow fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content">
                        <table class="table table-bordered" width="100%" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Subject</th>
                                    <th>Section</th>
                                    <th>Class Number</th>
                                    <th>Instructor</th>
                                    <th>Student Count</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
                                <th>no data</th>
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