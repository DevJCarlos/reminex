<?php

namespace App\Http\Controllers;
use App\Models\ExamTime;
use App\Models\ExamDay;
use Illuminate\Http\Request;

class ExamTimeController extends Controller
{
    public function saveExamTimes(Request $request){
        $data = $request->json()->all();
        $timesString = str_replace(['[', ']', '"'], '', $data['times']);
        $timesArray = explode(',', $timesString);
        // dd($timesArray);
        
        $latestExamDayID = ExamDay::latest('id')->value('id');
        $latestExamPeriodID = ExamDay::latest('id')->value('exam_period_ID');

        foreach ($timesArray as $time) {
            $trimmedTime = trim($time);

            if (!empty($trimmedTime)) {
                $examTime = new ExamTime([
                    'exam_time' => $trimmedTime,
                    'exam_day_ID' => $latestExamDayID,
                    'exam_period_ID' => $latestExamPeriodID
                ]);

                // dd($examTime);
                $examTime->save();
            }
        }

        return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
    }

    function index(){
        
        $examTimes = ExamTime::all();
        return view('exams.index', compact('examTimes'));
    }

}
    


    

    

