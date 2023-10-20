<?php

namespace App\Http\Controllers;
use App\Models\period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function store(Request $request)
    {
    
        // Retrieve data from the GlobalPeriod array
        $date = $request->date;
        $day_num = $request->day_num;
    
        // Save the data to the 'periods' table
        $period = new period;
        $period->date = $date;
        $period->day_num = $day_num;
        $period->save();
    
        // Redirect or respond as needed
        return response()->json([])->header('Location', route('exam.create'));

    }
    
    
}
