<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamSectionController extends Controller
{
    function saveExamSections(Request $request){
        $sec = $request->section;
        $classnums = $request->classnum;
        $ins = $request->instructor;
        $classcounts = $request->classcount;
        dd($classcounts);
        
        return response()->json([])->header('Location', route('exam.create'));
        
    }
}
