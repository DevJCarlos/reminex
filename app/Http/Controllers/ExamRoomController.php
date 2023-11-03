<?php

namespace App\Http\Controllers;
use App\Models\ExamRoom;
use App\Models\ExamDay;
use Illuminate\Http\Request;

class ExamRoomController extends Controller
{

    function saveExamRooms(Request $request) {
        $room = $request->room;

        
        $latestExamDayID = ExamDay::latest('id')->value('id');
        $latestExamPeriodID = ExamDay::latest('id')->value('exam_period_ID');

        foreach ($room as $nestedRooms){

            foreach ($nestedRooms as $individualRoomNames) {
                
                $roomString = implode(', ', $individualRoomNames);
    
                
                $trimmedRoomString = trim($roomString);
    
                if (!empty($trimmedRoomString)) {
                    $examRoom = new ExamRoom([
                        'room_name' => $trimmedRoomString,
                        'exam_day_ID' => $latestExamDayID,
                        'exam_time_ID' => $latestExamPeriodID
                    ]);
                    $examRoom->save();
                }
            }
        }
    
        return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
    }
}