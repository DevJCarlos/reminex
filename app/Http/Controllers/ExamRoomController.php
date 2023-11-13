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
    public function updateRoom(Request $request)
    {
        // Get the roomName and roomID from the request
        $roomName = $request->input('roomName');
        $roomID = $request->input('roomID');
        // dd($roomName);

        // Update the ExamRoom using the ExamRoom model
        ExamRoom::where('id', $roomID)->update(['room_name' => $roomName]);

        // You can add any additional logic or validation here

        // Return a response, e.g., a success message
        return response()->json(['message' => 'ExamRoom updated successfully']);
    }
}