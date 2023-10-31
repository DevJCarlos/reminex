<?php

namespace App\Http\Controllers;
use App\Models\ExamSubject;
use App\Models\ExamTime;
use Illuminate\Http\Request;


class ExamSubjectController extends Controller
{
    function saveExamSubjects(Request $request) {
        $subjects = $request->subjects;
    
        // Initialize an array to store exploded subjects
        $explodedSubjects = [];
    
        foreach ($subjects as $subjectData) {
            if (is_array($subjectData)) {
                // Explode strings within the sub-array and trim each part
                $explodedSubjectArray = [];
                foreach ($subjectData as $subjectString) {
                    if (is_string($subjectString)) {
                        $explodedSubjectArray = array_merge($explodedSubjectArray, explode(',', $subjectString));
                    }
                }
                $explodedSubjects[] = $explodedSubjectArray;
            } else {
                
            }
        }
        // $latestExamTime = ExamTime::latest()->first();
        $examTimes = ExamTime::latest()->get();
        for ($i = 0; $i < count($explodedSubjects); $i++) {
            if (isset($examTimes[$i])) {
                $subjectNameArray = $explodedSubjects[$i];
                $examTime = $examTimes[$i];
        
                foreach ($subjectNameArray as $subjectName) {
                    $examSubject = new ExamSubject(['subject_name' => $subjectName]);
                    $examTime->examSec()->save($examSubject);
                }
            }
        }
        return response()->json()->header('Location', route('exam.create'));
    }
}
