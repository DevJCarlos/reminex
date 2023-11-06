<?php

namespace App\Http\Controllers;
use App\Models\ExamTime;
use App\Models\ExamDay;
use App\Models\ExamSubject;
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
    public function index(){

        return view('exams.index');
    }

    public function fetch(Request $request)
    {
        $period = $request->period;
        $day = $request->day;
    
        $filteredExamTimes = ExamTime::select('exam_time')
        ->when($period = 'Prelims', function ($query) use ($day) {
            $query->join('exam_days', 'exam_times.exam_day_ID', '=', 'exam_days.id')
                ->where('exam_times.exam_period_ID', 1)
                ->where('exam_days.day_num', $day); 
        })
        ->get();

        $filteredExamSubjects = ExamSubject::select('exam_subjects.*')
        ->when($period = 'Prelims', function ($query) use ($day) {
            $query
                ->join('exam_times', 'exam_subjects.exam_time_ID', '=', 'exam_times.id')
                ->join('exam_days', 'exam_subjects.exam_day_ID', '=', 'exam_days.id')
                ->where('exam_times.exam_period_ID', 1)
                ->where('exam_days.day_num', $day);
        })
        ->get();
        $combinedData = [
            'examTimes' => $filteredExamTimes,
            'examSubjects' => $filteredExamSubjects,
        ];
        // dd($combinedData);

    
        return response()->json($combinedData);
    }
    

}



    


    

    

