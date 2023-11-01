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

        foreach ($room as $nestedRooms){

            foreach ($nestedRooms as $individualRoomNames) {
                
                $roomString = implode(', ', $individualRoomNames);
    
                
                $trimmedRoomString = trim($roomString);
    
                if (!empty($trimmedRoomString)) {
                    $examRoom = new ExamRoom([
                        'room_name' => $trimmedRoomString,
                        'exam_day_ID' => $latestExamDayID
                    ]);
                    $examRoom->save();
                }
            }
        }
    
        return response()->json([])->header('Location', route('exam.create'));
    }
}