<div class="card">
    <div class="card-body">
        <h3 class="card-title">Generate Exam Table</h3>
        <br>
        <br>
        <div class="bd-example" id="gentable" style="text-align: center;">
            <table id="gentab" class="table table-bordered" width="100%" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Subject</th>
                        <th>Room</th>
                        <th>Sections</th>
                        <th>Section Number</th>
                        <th>Instructor</th>
                        <th>Class Count</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    
                </tbody>
            </table>
        </div>
            <!-- <form action="{{ route('periods.store') }}" method="POST">
                @csrf 
                 -->
                
                
                <button type="button" class="btn btn-success text-white"
                            onclick="SaveInfo()">Save Schedule</button>
            <!-- </form> -->
    </div>
</div>
