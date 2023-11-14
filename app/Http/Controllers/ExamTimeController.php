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


        $Prelim1 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 1);
        })
        ->where('exam_period_ID', 1)
        ->get();

        $Prelim2 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 2);
        })
        ->where('exam_period_ID', 1)
        ->get();

        $Prelim3 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 3);
        })
        ->where('exam_period_ID', 1)
        ->get();
        //midterm days
        $Midterm1 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 1);
        })
        ->where('exam_period_ID', 2)
        ->get();

        $Midterm2 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 2);
        })
        ->where('exam_period_ID', 2)
        ->get();

        $Midterm3 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 3);
        })
        ->where('exam_period_ID', 2)
        ->get();

        //prefi days
        $Prefi1 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 1);
        })
        ->where('exam_period_ID', 3)
        ->get();

        $Prefi2 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 2);
        })
        ->where('exam_period_ID', 3)
        ->get();

        $Prefi3 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 3);
        })
        ->where('exam_period_ID', 3)
        ->get();

        //finals daya
        $Final1 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 1);
        })
        ->where('exam_period_ID', 4)
        ->get();

        $Final2 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 2);
        })
        ->where('exam_period_ID', 4)
        ->get();

        $Final3 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
        ->whereHas('examDay', function ($query) {
            $query->where('day_num', 3);
        })
        ->where('exam_period_ID', 4)
        ->get();


    
 
        if ($period == ['Prelims']) {
            if ($day == ['1']) {
                // dd('tama and day 1');
                return response()->json(['examTimes' => $Prelim1]);
            }
            elseif ($day == ['2']) {
                // dd('tama and day 2');
                return response()->json(['examTimes' => $Prelim2]);
            }
            elseif ($day == ['3']) {
                // dd('tama and day 3');
                return response()->json(['examTimes' => $Prelim3 ]);
            }
            else{
                dd('error');
            }
        
        }if ($period == ['Midterms']) {
            if ($day == ['1']) {
                // dd('tama and day 1');
                return response()->json(['examTimes' => $Midterm1]);
            }
            elseif ($day == ['2']) {
                // dd('tama and day 2');
                return response()->json(['examTimes' => $Midterm2]);
            }
            elseif ($day == ['3']) {
                // dd('tama and day 3');
                return response()->json(['examTimes' => $Midterm3 ]);
            }
            else{
                dd('error');
            }
        }if ($period == ['Pre-Finals']) {
            if ($day == ['1']) {
                // dd('tama and day 1');
                return response()->json(['examTimes' => $Prefi1]);
            }
            elseif ($day == ['2']) {
                // dd('tama and day 2');
                return response()->json(['examTimes' => $Prefi2]);
            }
            elseif ($day == ['3']) {
                // dd('tama and day 3');
                return response()->json(['examTimes' => $Prefi3 ]);
            }
            else{
                dd('error');
            }

        }if ($period == ['Finals']) {
            if ($day == ['1']) {
                // dd('tama and day 1');
                return response()->json(['examTimes' => $Final1]);
            }
            elseif ($day == ['2']) {
                // dd('tama and day 2');
                return response()->json(['examTimes' => $Final2]);
            }
            elseif ($day == ['3']) {
                // dd('tama and day 3');
                return response()->json(['examTimes' => $Final3 ]);
            }
            else{
                dd('error');
            }

        }
        
        else {
            dd('error no period selected');
        }
    
    }
    

}



    


    

    

