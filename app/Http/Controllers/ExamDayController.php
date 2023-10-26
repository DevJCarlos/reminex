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

        // Log::info("Received date: $date, day_num: $day_num");
        // Log::info("Received date: $period");

        
        if ($period === 'Prelim') {
            
            $examPeriod = ExamPeriod::where('period_name', 'Prelims')->first();

            // Log::info("ExamPeriod query result: " . json_encode($examPeriod));

            if ($examPeriod) {
               
                $examDay = new ExamDay([
                    'date' => $date,
                    'day_num' => $day_num,
                ]);

                $examPeriod->examDays()->save($examDay);

                
                return response()->json([])->header('Location', route('exam.create'));
            }
        }

        
        return response()->json(['message' => 'Invalid period or ExamPeriod not found'], 400);
    }

    
}
