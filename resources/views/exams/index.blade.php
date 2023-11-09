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
                                        <option value=" ">--Choose Period--</option>
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
                                    <option value =" ">--Choose Day--</option>
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
                                <th>Proctors</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

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

var selectedValues = [];
var selectedValuesDay = [];

function getValue() {
    selectedValues = [$('#dropdown1').val()];
    selectedValuesDay = [$('#dropdown2').val()];
}

$(document).ready(function() {
    $('#dropdown2').change(function() {
        selectedOption1 = $('#dropdown2 option:selected').text();
        if (selectedOption1 === "Day 1" || selectedOption1 === "Day 2" || selectedOption1 === "Day 3") {
            getValue();
            if (selectedValues) {
                handleFormSubmit();
            }
        }
    });

    $('#dropdown1').change(function() {
        selectedOption = $('#dropdown1 option:selected').text();
        if (selectedOption === "Prelims" || selectedOption === "Midterms" || selectedOption === "Pre-Finals" || selectedOption === "Finals") {
            getValue();
            if (selectedValues) {
                handleFormSubmit();
            }
        }
    });
});

function handleFormSubmit() {
    var period = selectedValues; 
    var day = selectedValuesDay;
    

    
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
        console.log(data);

        var TimeSchedule = [];
        data.examTimes.forEach(function(examTime) {
            var TimeSlots = { TimeSlot: examTime.exam_time };
            var Subjects = [];

            examTime.exam_sub.forEach(function(subject) {
                var SubjectName = { Subject: subject.subject_name };
                var Sections = [];

                subject.exam_sectionss.forEach(function(subjectSec) {
                    Sections.push({
                        Section: subjectSec.section_name,
                        Code: subjectSec.class_num,
                        Instructor: subjectSec.Instructor,
                        StudentCount: subjectSec.class_count
                    });
                });

                SubjectName.Sections = Sections;
                Subjects.push(SubjectName);
            });

            TimeSlots.Subjects = Subjects;
            TimeSchedule.push(TimeSlots);
        });

        console.log(TimeSchedule);

        console.log('new',TimeSchedule);
        
        

        

            

            // data.examTimes.forEach(function(examTime) {
            //     console.log('Time:', examTime.exam_time);
                
            //     if (examTime.examSub) {
            //         examTime.examSub.forEach(function(examSub) {
                        

            //             var sections = examSub.examSectionss;
            //             var subjectSections = [];
            //             // console.log('new',subjectSections);

            //             sections.forEach(function(section) {
                            
            //                 var sectionData = {
            //                     section_name: section.section_name,
            //                     class_num: section.class_num,
            //                     instructor: section.instructor,
            //                     class_count: section.class_count,
            //                 };

            //                 subjectSections.push(sectionData);
            //                 console.log('new',subjectSections);
            //             });
            //             examSub.subject_section = subjectSections;
                        
            //         });
            //     }
            // });
            
        },

        error: function() {
            console.log('Error fetching data');
        }
    });
}
   

</script>
@endsection