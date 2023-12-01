<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamUser;
use App\Models\ExamDay;
use App\Models\ExamTime;
use App\Models\ExamSection;
use App\Models\IrregStudentSub;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use App\Models\User;

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
            $userName = $user->name;

            
            $Prelim1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query){
                $query->where('day_num', 1);
                
            })
            ->where('exam_period_ID', 1)
            ->get();

            $Prelim2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 1)
            ->get();
    
            $Prelim3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 1)
            ->get();
            //midterm days
            $Midterm1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            //prefi days
            $Prefi1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            //finals daya
            $Final1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 4)
            ->get();
        
            
            if ($period == 'Prelims') {
                // dd($period);
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prelim1, 'userName' => $userName]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prelim2, 'userName' => $userName]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prelim3, 'userName' => $userName ]);
                }
                else{
                    dd('error');
                }
            
            }if ($period == 'Midterms') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Midterm1, 'userName' => $userName]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Midterm2, 'userName' => $userName]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Midterm3, 'userName' => $userName ]);
                }
                else{
                    dd('error');
                }
            }if ($period == 'Pre-Finals') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prefi1, 'userName' => $userName]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prefi2, 'userName' => $userName]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prefi3, 'userName' => $userName ]);
                }
                else{
                    dd('error');
                }
    
            }if ($period == 'Finals') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Final1, 'userName' => $userName]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Final2, 'userName' => $userName]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Final3 , 'userName' => $userName]);
                }
                else{
                    dd('error');
                }
    
            }
            // return response()->json(['examTimes' => $Prelim1, 'userName' => $userName]);
        } 
         else {
            abort(403, 'Unauthorized');
        }
    }
    public function select(Request $request){
       
        $user = Auth::user();

    
        $filesInListSection = Storage::files('public/listsection');
        $procSubject = [];

        
        foreach ($filesInListSection as $filePath) {
            
            $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
            $records = $csv->getRecords();

            foreach ($records as $record) {
                
                if ($record[25] == $user->name) {
                    
                    $subject = $record[4];

                    
                    if (!in_array($subject, array_column($procSubject, 'subject'))) {
                        $procSubject[] = $subject;
                    }
                }
            }
        }
        
        $filesInUploads = Storage::files('public/uploads');
        $MatrixPrelim = [];
        foreach ($filesInUploads as $filePath) {
            $csv = Reader::createFromPath(storage_path("app/{$filePath}"), 'r');
            $records = $csv->getRecords();

            foreach ($records as $record) {
                
                if ($record[4] === 'Written') {
                    
                    $MatrixPrelim[] = $record[3];
                }
                if ($record[5] === 'Written') {
                    
                    $MatrixMidterm[] = $record[3];
                }
                if ($record[6] === 'Written') {
                    
                    $MatrixPrefinal[] = $record[3];
                }
                if ($record[7] === 'Written') {
                    
                    $MatrixFinal[] = $record[3];
                }
            }
        }
        // dd($MatrixFinal);
        
        $commonValues1 = array_intersect($procSubject, $MatrixPrelim);
        $subjectCounts1 = [];

        foreach ($commonValues1 as $value) {
        
            if (!isset($subjectCounts1[$value])) {
                $subjectCounts1[$value] = 1;
            } else {
            
                $subjectCounts1[$value]++;
            }
        }
        $commonValues2 = array_intersect($procSubject, $MatrixMidterm);
        $subjectCounts2 = [];

        foreach ($commonValues2 as $value) {
        
            if (!isset($subjectCounts2[$value])) {
                $subjectCounts2[$value] = 1;
            } else {
            
                $subjectCounts2[$value]++;
            }
        }
        $commonValues3 = array_intersect($procSubject, $MatrixPrefinal);
        $subjectCounts3 = [];

        foreach ($commonValues3 as $value) {
        
            if (!isset($subjectCounts3[$value])) {
                $subjectCounts3[$value] = 1;
            } else {
            
                $subjectCounts3[$value]++;
            }
        }
        $commonValues4 = array_intersect($procSubject, $MatrixFinal);
        $subjectCounts4 = [];

        foreach ($commonValues4 as $value) {
        
            if (!isset($subjectCounts4[$value])) {
                $subjectCounts4[$value] = 1;
            } else {
            
                $subjectCounts4[$value]++;
            }
        }


        $PrelimCount = count($subjectCounts1);
        $MidtermCount = count($subjectCounts1);
        $PrefinalCount = count($subjectCounts1);
        $FinalCount = count($subjectCounts1);
        $userNameID = $user->id;
        $userNamesubcounter = $user->subject_count;

        if ($user && $user->hasRole('teacher')) {
            $period = $request->period;
            $day = $request->day;
            $userName = $user->name;

            
            $Prelim1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query){
                $query->where('day_num', 1);
                
            })
            ->where('exam_period_ID', 1)
            ->get();

            $Prelim2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 1)
            ->get();
    
            $Prelim3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 1)
            ->get();
            //midterm days
            $Midterm1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            //prefi days
            $Prefi1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            //finals daya
            $Final1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 4)
            ->get();
        
            
            if ($period == 'Prelims') {

                $user = User::where('id', $userNameID)->first();
                if ($user && $user->subject_count === null) {
                    
                    $user->subject_count = $PrelimCount;
                    $user->save();
                }
                // dd($userNameID);
                // dd($period);
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prelim1, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prelim2, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prelim3, 'userName' => $userName, 'subcount' => $userNamesubcounter ]);
                }
                else{
                    dd('error');
                }
            
            }if ($period == 'Midterms') {

                $user = User::where('id', $userNameID)->first();
                if ($user && $user->subject_count === null) {
                    
                    $user->subject_count = $MidtermCount;
                    $user->save();
                }
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Midterm1, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Midterm2, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Midterm3, 'userName' => $userName , 'subcount' => $userNamesubcounter]);
                }
                else{
                    dd('error');
                }
            }if ($period == 'Pre-Finals') {

                $user = User::where('id', $userNameID)->first();
                if ($user && $user->subject_count === null) {
                    
                    $user->subject_count = $PrefinalCount;
                    $user->save();
                }
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prefi1, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prefi2, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prefi3, 'userName' => $userName, 'subcount' => $userNamesubcounter ]);
                }
                else{
                    dd('error');
                }
    
            }if ($period == 'Finals') {

                $user = User::where('id', $userNameID)->first();
                if ($user && $user->subject_count === null) {
                    
                    $user->subject_count = $FinalCount;
                    $user->save();
                }
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Final1, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Final2, 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Final3 , 'userName' => $userName, 'subcount' => $userNamesubcounter]);
                }
                else{
                    dd('error');
                }
    
            }
            // return response()->json(['examTimes' => $Prelim1, 'userName' => $userName]);
        } 
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        if ($user && $user->hasRole('teacher')) {


        
        $secID = $request->secID;
        $userName = $user->name;
        $userNameID = $user->id;
        $selectionLeft = $request->selectSub;
        // dd($userName);
        // dd($selectionLeft);

        
        ExamSection::where('id', $secID)->update([
            'proctor_name' => $userName,
            
        ]);
        }
        User::where('id', $userNameID)->update([
            'subject_count' => $selectionLeft,

        ]);

        return response()->json(['success', 'Updated Successfully']);
    }
    public function deselect(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        if ($user && $user->hasRole('teacher')) {


        
        $secID = $request->secID;
        $userName = $user->name;
        $userNameID = $user->id;
        $selectnum = $request->subcount;
        // dd($userName);
        // dd($selectnum);

        
        ExamSection::where('id', $secID)->update([
            'proctor_name' => null,
            
        ]);

        User::where('id', $userNameID)->update([
            'subject_count' => $selectnum,

        ]);
        } 

        return response()->json(['success', 'Updated Successfully']);
    }

    public function pullExamstudent(Request $request){
       
        $user = Auth::user();
        $userID = $user->id;

        // Retrieve only the records for the current user
        $irregStudent = IrregStudentSub::where('irreg_students_id', $userID)->get();
        // dd($irregStudent);
        $studentIrregID = $irregStudent->pluck('irreg_students_id');
        $studentSubjects = $irregStudent->pluck('student_subject');
        $subjectInstructors = $irregStudent->pluck('subject_instructor');
        $subjectSections = $irregStudent->pluck('subject_section');

        

    
        if ($user && $user->hasRole('student')) {
           
            $period = $request->period;
            $day = $request->day;
            $userName = $user->name;
            $userSection = $user->student_sec;
            $userStatus = $user->student_status;
            // dd($userStatus);
            // $irregID = $irregStudent->irreg_students_id;
            
            // $irregSub = $irregStudent->student_subject;
            // dd($irregSub);
            // $irregInstructor = $irregStudent->subject_instructor;
            // $irregSec = $irregStudent->subject_section;

            
            $Prelim1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query){
                $query->where('day_num', 1);
                
            })
            ->where('exam_period_ID', 1)
            ->get();

            $Prelim2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 1)
            ->get();
    
            $Prelim3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 1)
            ->get();
            //midterm days
            $Midterm1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            $Midterm3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 2)
            ->get();
    
            //prefi days
            $Prefi1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            $Prefi3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 3)
            ->get();
    
            //finals daya
            $Final1 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 1);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final2 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 2);
            })
            ->where('exam_period_ID', 4)
            ->get();
    
            $Final3 = ExamTime::with(['examSub.examSectionss', 'examRooms', 'examDay'])
            ->whereHas('examDay', function ($query) {
                $query->where('day_num', 3);
            })
            ->where('exam_period_ID', 4)
            ->get();
        
            
            if ($period == 'Prelims') {
                // dd($period);
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prelim1, 'userSection' => $userSection, 'userStatus' => $userStatus, 'irreg_info' => $irregStudent ]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prelim2, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prelim3, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                else{
                    dd('error');
                }
            
            }if ($period == 'Midterms') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Midterm1, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Midterm2, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Midterm3, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                else{
                    dd('error');
                }
            }if ($period == 'Pre-Finals') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Prefi1, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Prefi2, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Prefi3, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                else{
                    dd('error');
                }
    
            }if ($period == 'Finals') {
                if ($day == '1') {
                    // dd('tama and day 1');
                    return response()->json(['examTimes' => $Final1, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '2') {
                    // dd('tama and day 2');
                    return response()->json(['examTimes' => $Final2, 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                elseif ($day == '3') {
                    // dd('tama and day 3');
                    return response()->json(['examTimes' => $Final3 , 'userSection' => $userSection, 'userStatus' => $userStatus]);
                }
                else{
                    dd('error');
                }
    
            }
            // return response()->json(['examTimes' => $Prelim1, 'userName' => $userName]);
        } 
         else {
            abort(403, 'Unauthorized');
        }
    }
    
    
}
    
    
    



