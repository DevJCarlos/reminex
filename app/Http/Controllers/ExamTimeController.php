<?php

namespace App\Http\Controllers;
use App\Models\ExamTime;
use App\Models\ExamDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamTimeController extends Controller
{
    public function saveExamTimes(Request $request)
    {
        $data = $request->json()->all();
        $timesString = str_replace(['[', ']', '"'], '', $data['times']);
        $timesArray = explode(',', $timesString);
        
        foreach ($timesArray as $time) {
            $trimmedTime = trim($time);
    
            if (!empty($trimmedTime)) {
                // Create an ExamTime
                $examTime = new ExamTime(['exam_time' => $trimmedTime]);
                $examTime->save();

                // Create an associated ExamDay and attach the ExamTime to it
                $examDay = new ExamDay();
                $examDay->examTimes()->save($examTime);
            }
        }

        return response()->json([])->header('Location', route('exam.create'));
    }
}
    
    


    

    

