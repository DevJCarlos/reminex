<?php

namespace App\Http\Controllers;
use App\Models\ExamDay;
use App\Models\ExamPeriod;
use App\Models\ExamRoom;
use App\Models\ExamSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamDayController extends Controller
{

    
    public function saveDay(Request $request)
    {
        $date = $request->date;
        $day_num = $request->day_num;
        $period = $request->period;
    
        if ($period === 'Prelim') {
            $examPeriod = ExamPeriod::where('period_name', 'Prelims')->first();
        } elseif ($period === 'Midterm') {
            $examPeriod = ExamPeriod::where('period_name', 'Midterms')->first();
        }elseif ($period === 'Pre-Final') {
            $examPeriod = ExamPeriod::where('period_name', 'Pre-Finals')->first();
        }elseif ($period === 'Finals') {
            $examPeriod = ExamPeriod::where('period_name', 'Finals')->first();
        }
         else {
            return response()->json(['message' => 'Invalid period'], 400);
        }
    
        if ($examPeriod) {
            $examDay = new ExamDay([
                'date' => $date,
                'day_num' => $day_num,
            ]);
    
            $examPeriod->examDays()->save($examDay);
    
            return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
        }
    
        return response()->json(['message' => 'ExamPeriod not found'], 400);
    }
    function index(){
        
        $examDays = ExamDay::all();
        return view('exams.index', compact('examDays'));
    }

    public function deleteExamDay(Request $request)
    {
        $period = $request->input('period');
        $day = $request->input('day');
        // dd($period );

        if ($period === 'Prelims') {
            $period = 1;
        }
        elseif ($period === 'Midterms') {
            $period = 2;
        }
        elseif ($period === 'Pre-Finals') {
            $period = 3;
        }
        elseif ($period === 'Finals') {
            $period = 4;
        }
        
        
        $examDay = ExamDay::where('exam_period_ID', $period)
                        ->where('day_num', $day)
                        ->get();

        
        if ($examDay->isNotEmpty()) {
            
            ExamDay::where('exam_period_ID', $period)
                ->where('day_num', $day)
                ->delete();

            return response()->json(['message' => 'deleted successfully']);
        } else {
            return response()->json(['message' => 'No matching exam day found']);
        }
    }
    public function deleteSub(Request $request){
        $subjectID = $request->input('subject_ID');
        $roomID = implode(',', $request->input('room_ID'));


        // dd($roomID);
        $room = ExamRoom::find($roomID);
        $section = ExamSection::find($subjectID);
        
        

        if (!$room || !$section) {
            // Records not found
            return response()->json(['message' => 'Records not found.'], 404);
        }

        // Delete records
        $room->delete();
        $section->delete();

    // Return success response
    return response()->json(['message' => 'Records deleted successfully.']);
    }
    

    
}
