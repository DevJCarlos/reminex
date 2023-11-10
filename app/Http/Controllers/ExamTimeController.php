<?php

namespace App\Http\Controllers;
use App\Models\ExamTime;
use App\Models\ExamDay;
use App\Models\ExamRoom;
use App\Models\ExamSubject;
use App\Models\ExamSection;
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

        
        
        $filteredExamTimes = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->when($period == 'Prelims', function ($query) use ($day) {
            $query
                ->join('exam_days', 'exam_times.exam_day_ID', '=', 'exam_days.id')
                ->where('exam_times.exam_period_ID', 1)
                ->where('exam_days.day_num', $day);
        })
        ->when($period == 'Midterm', function ($query) use ($day) {
            $query
                ->join('exam_days', 'exam_times.exam_day_ID', '=', 'exam_days.id')
                ->where('exam_times.exam_period_ID', 1)
                ->where('exam_days.day_num', $day);
        })
        ->get();
        
        
    
        return response()->json(['examTimes' => $filteredExamTimes]);

    
    }
    

}



    


    

    

