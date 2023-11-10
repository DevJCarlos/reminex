<?php

namespace App\Http\Controllers;
use App\Models\ExamRoom;
use App\Models\ExamDay;
use App\Models\ExamTime;
use Illuminate\Http\Request;

class ExamRoomController extends Controller
{

    function saveExamRooms(Request $request) {
        $room = $request->room;
        // dd($room);
        foreach ($room as $roomsData){
            if (is_array($roomsData)) {

            $RoomsData[] = $roomsData;
            // dd($RoomsData);
            } else {
                dd('error in ExamSubjectController', $roomsData);
            }
            
        }
        
        $latestExamDayID = ExamDay::latest('id')->value('id');
        $latestExamPeriodID = ExamDay::latest('id')->value('exam_period_ID');
        $examTimes = ExamTime::latest()->get();
        for ($i = 0; $i < count($RoomsData); $i++) {
            if (isset($examTimes[$i])) {
                $RoomArray = $RoomsData[$i];
                $examTime = $examTimes[$i];
                // dd($RoomArray);
        
                foreach ($RoomArray as [$roomName]) {
                    $examroom = new ExamRoom(['room_name' => $roomName]);
                    $examroom->exam_day_id = $latestExamDayID;
                    $examroom->exam_period_id = $latestExamPeriodID;
                    $examTime->examRooms()->save($examroom);
                }
            }
        }
                     
    
        return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
    }
}
// $room = $request->room;
// foreach ($room as $nestedRooms) {
//     foreach ($nestedRooms as $individualRoomNames) {
//         $roomString = implode(', ', $individualRoomNames);
//         $trimmedRoomString = trim($roomString);
//         $RoomsData[] = [$trimmedRoomString];
//     }
// }
// dd($RoomsData);

// $latestExamDayID = ExamDay::latest('id')->value('id');
// $latestExamPeriodID = ExamDay::latest('id')->value('exam_period_ID');
// $examTimes = ExamTime::latest()->get();

// for ($i = 0; $i < count($RoomsData); $i++) {
//     if (isset($examTimes[$i])) {
//         $RoomArray = $RoomsData[$i];
//         $examTime = $examTimes[$i];

//         foreach ($RoomArray as $roomName) {
//             $examroom = new ExamRoom(['room_name' => $roomName]);
//             $examroom->exam_day_id = $latestExamDayID;
//             $examroom->exam_period_id = $latestExamPeriodID;
//             $examroom->examTime()->associate($examTime); // Use associate method
//             $examroom->save();
//         }
//     }
// }