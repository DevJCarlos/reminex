<div class="card">
    <div class="accordion-item">
        <div class="card-body">
            <div class="accordion-header">Upload CSV and Selections
                <i class="accordion-arrow fas fa-chevron-down"></i>
            </div>
            <div class="accordion-content">
                {{-- include the csv upload file --}}
                @include('exams.partials.csv-upload-form')
                <div class="border-top">
                    <div class="card-body">
                        <h3 class="card-title">Selection</h3>
                        <br>
                        <br>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="period-select" class="ml-3 mb-0">Select Period: </label>
                            <select name="period-select" id="period-select"  class="form-control ml-1" style="width: 200px;">
                                <option value="-Select Period-">-Select Period-</option>
                                <option value="Prelim">Prelims</option>
                                <option value="Midterm">Midterms</option>
                                <option value="Pre-Final">Pre-Finals</option>
                                <option value="Finals">Finals</option>
                            </select>

                            <label for="date-picker" class="ml-3 mb-0">Date of Exam: </label>
                            <input type="date" name="date-picker" id="date-picker"  class="form-control ml-1" style="width: 200px;">

                            <label for="day-select" class="ml-3 mb-0">Select Day:</label>
                            <select type="text" name="day-select" id="day-select" class="form-control ml-1" style="width: 200px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" >3</option>
                            </select>
                            <label for="time-picker" class="ml-3 mb-0">Exam Starting Time: </label>
                            <input type="time" name="time-picker" id="time-picker" class="form-control ml-1" style="width: 200px;">
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
                            <div class="search-bar">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="text" id="searchInput" placeholder="Search by Course Title" class="form-control" style="width: 200px;">
                                        </td>
                                        <td>
                                            <select id="searchProgram" class="form-control" style="width: 200px;">
                                                <option value="Selection">--Select Program--</option>
                                                <option value="GE">GE</option>
                                                <option value="BSIT">BSIT</option>
                                                <option value="BSCpE">BSCpE</option>
                                                <option value="BSCS">BSCS</option>
                                                <option value="BSIS">BSIS</option>
                                                <option value="ACT">ACT</option>
                                                <option value="ASCT">ASCT</option>
                                                <option value="ITP">ITP</option>
                                                <option value="BSBA">BSBA</option>
                                                <option value="BSRTCS">BSRTCS</option>
                                                <option value="BSA">BSA</option>
                                                <option value="BSAIS">BSAIS</option>
                                                <option value="BSMA">BSMA</option>
                                                <option value="BSTM">BSTM</option>
                                                <option value="TEM">TEM</option>
                                                <option value="BACOMM">BACOMM</option>
                                                <option value="BMMA">BMMA</option>
                                                <option value="BAPYSCH">BAPYSCH</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="searchYear" class="form-control" style="width: 200px;">
                                                <option value="Selection">--Select Year--</option>
                                                <option value="DOP">DOP</option>
                                                <option value="1Y">1Y</option>
                                                <option value="2Y">2Y</option>
                                                <option value="3Y">3Y</option>
                                                <option value="4Y">4Y</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
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
                            <br>
                            <ul class="room-list">
                                <!-- "Select All" checkbox -->
                                <li class="room-item">
                                    <label class="customcheckbox">
                                        <input type="checkbox" id="selectAllRooms">
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="room-name">Select All</span>
                                </li>

                                <!-- Room checkboxes -->
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
