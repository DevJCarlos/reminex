<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamSectionController extends Controller
{
    function saveExamSections(Request $request){
        $data = $request->json()->all();
        // dd($data);
        return response()->json([])->header('Location', route('exam.create'));
        
    }
}
