<?php

namespace App\Http\Controllers;

use App\Models\ExamSection;
use App\Models\ExamSubject;
use App\Models\ExamDay;
use Illuminate\Http\Request;


class ExamSectionController extends Controller
{
    function saveExamSections(Request $request) {
        $sec = $request->section;
        $classnums = $request->classnum;
        $ins = $request->instructor;
        $classcounts = $request->classcount;
    
        $explodedSections = [];
        $explodedClassnum = [];
        $explodedInstructor = [];
        $explodedClasscounts = [];
    
        // Loop through the provided data
        for ($i = 0; $i < count($sec); $i++) {
            $sectionData = $sec[$i];
            $classNumData = $classnums[$i];
            $instructorData = $ins[$i];
            $classCountData = $classcounts[$i];
    
            if (is_array($sectionData)) {
                $explodedSectionArray = [];
                foreach ($sectionData as $sectionString) {
                    if (is_string($sectionString)) {
                        $explodedSectionArray = array_merge($explodedSectionArray, explode(' ,', $sectionString));
                    }
                }
                $explodedClassnumArray = [];
                foreach ($classNumData as $classnumString) {
                    if (is_string($classnumString)) {
                        $explodedClassnumArray = array_merge($explodedClassnumArray, explode(' ,', $classnumString));
                    }
                }
                $explodedInstructorArray = [];
                foreach ($instructorData as $instructorString) {
                    if (is_string($instructorString)) {
                        $explodedInstructorArray = array_merge($explodedInstructorArray, explode(' ,', $instructorString));
                    }
                }
                $explodedClasscountArray = [];
                foreach ($classCountData as $classcountString) {
                    if (is_string($classcountString)) {
                        $explodedClasscountArray = array_merge($explodedClasscountArray, explode(' ,', $classcountString));
                    }
                }
                //emodify ang explode nga into ',' kung gusto nimo hiwalay tanan

                
                $explodedSections[] = $explodedSectionArray;
                $explodedClassnum[] = $explodedClassnumArray;
                $explodedInstructor[] = $explodedInstructorArray;
                $explodedClasscounts[] = $explodedClasscountArray;
                    
            }
        }
        $latestExamDayID = ExamDay::latest('id')->value('id');
        $latestExamPeriodID = ExamDay::latest('id')->value('exam_period_ID');
        $latestExamSubjects = ExamSubject::latest()->get();
        for ($i = 0; $i < count($explodedSections); $i++) {
            if (isset($latestExamSubjects[$i])) {
                $sectionNameArray = $explodedSections[$i];
                $classnumArray = $explodedClassnum[$i];
                $InstructorArray = $explodedInstructor[$i];
                $classcountArray = $explodedClasscounts[$i]; 
                
                $latestExamSubject = $latestExamSubjects[$i];
        
                foreach ($sectionNameArray as $index => $sectionName) {
                    $examSubject = new ExamSection([
                        'exam_day_ID' => $latestExamDayID,
                        'exam_period_ID' => $latestExamPeriodID,
                        'section_name' => $sectionName,
                        'class_num' => $classnumArray[$index], // Include class number
                        'instructor' => $InstructorArray[$index], // Include instructor
                        'class_count' => $classcountArray[$index] // Include class count
                    ]);
                    $latestExamSubject->examSections()->save($examSubject);
                }
            }
        
        }
        return response()->json(['message' => 'Successful'])->header('Location', route('exam.create'));
    
        
    }
    
}
