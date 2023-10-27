<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamSubjectController extends Controller
{
    function saveExamSubjects(Request $request){
        $data = $request->json()->all();
        // dd($data);
        return response()->json([])->header('Location', route('exam.create'));
    }
}
