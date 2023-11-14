<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamUser;
use App\Models\ExamDay;

class ExamUserController extends Controller
{
   

    public function saveExamData(Request $request){
        $period = $request->input('period');
        $day = $request->input('day');
        
        
        $latestExamDayID = ExamDay::latest('id')->value('id');

        
        if ($latestExamDayID) {
            $examUser = new ExamUser([
                'period_name' => $period, 
                'day' => $day,
                'exam_day_ID' => $latestExamDayID, 
            ]);

            $examUser->save();

            return response()->json(['message' => 'Data saved successfully']);
        } else {
            return response()->json(['message' => 'Error: No data ID']);
        }
    }
    public function pullExam(Request $request)
    {
        
        $period = $request->period;
        $day = $request->day;
        dd($period, $day);
    
        
        $latestExamDay = ExamDay::latest('id')->first();
    
        
        if ($latestExamDay) {
            
            $examUserData = ExamUser::where([
                'period_name' => $period,
                'day' => $day,
                'exam_day_ID' => $latestExamDay->id,
            ])->get();
    
            
            $examUserData->load('examDay.examSubject');
            dd($examUserData);
    
            return response()->json(['examUserData' => $examUserData]);
            
        } else {
            return response()->json(['message' => 'Error: No data ID']);
        }
    }
    


}
