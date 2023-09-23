<div class="card">
    <div class="accordion-item">
        <div class="card-body">
            <div class="accordion-header">Upload CSV and Selections
                <i class="accordion-arrow fas fa-chevron-down"></i>
            </div>
            <div class="accordion-content">
                {{-- include the cvs upload file --}}
                @include('exams.partials.csv-upload-form')
                <div class="border-top">
                    <div class="card-body">
                        <h3 class="card-title">Selection</h3>
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
                            <input type="time" name="time-picker" id="time-picker" class="ml-1">
                        </div>
                        <button type="button" class="btn btn-success text-white"
                            onclick="displaySelectedOption()">Add</button>
                        <div id="csvData"></div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <h3 class="card-title">Selection of Subjects</h3>
                            <br>
                            <br>
                            <div>
                                <input type="text" id="searchInput" placeholder="Search">
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
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <h3 class="card-title">Selection of Rooms</h3>
                            <ul class="room-list">
                                @foreach ($rooms as $room)
                                    <li class="room-item">
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox1">
                                            <span class="checkmark"></span>
                                        </label>

                                        <span class="room-name">{{ $room->room_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
