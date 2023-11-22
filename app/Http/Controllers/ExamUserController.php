<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamUser;
use App\Models\ExamDay;
use App\Models\ExamTime;
use App\Models\ExamSection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

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
    public function pullExam(Request $request){
       
        $user = Auth::user();
    
        if ($user && $user->hasRole('teacher')) {
            $period = $request->period;
            $day = $request->day;
    
           
            if ($period === "Prelims" && $day === "1") {
                // dd($day);
                
                $examUserData = ExamUser::where([
                    'period_name' => $period,
                    'day' => $day,
                ])->with('examDay.examSubject:*', 'examDay.userexamTime:*', 'examDay.examSections:*')->get();
                
                
                // dd($examUserData);
            } 
            
    
            return response()->json(['examUserData' => $examUserData]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function select(Request $request){
       
        $user = Auth::user();
    
        if ($user && $user->hasRole('teacher')) {
            $period = $request->period;
            $day = $request->day;
            $userName = $user->name;
    
            $Prelim1 = ExamTime::with(['examSub.examSectionss', 'examRooms'])
            ->whereHas('examDay', function ($query){
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
        } 
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        if ($user && $user->hasRole('teacher')) {


        
        $secID = $request->secID;
        $userName = $user->name;
        // dd($userName);

        
        ExamSection::where('id', $secID)->update([
            'proctor_name' => $userName,
            
        ]);
        } 

        return response()->json(['success', 'Updated Successfully']);
    }
    
    
}
    
    
    



