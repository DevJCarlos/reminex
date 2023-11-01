<?php

namespace App\Http\Controllers;
use App\Models\ExamDay;
use App\Models\ExamPeriod;
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
    

    
}
