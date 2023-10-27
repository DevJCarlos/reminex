<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamRoomController extends Controller
{
    function saveExamRooms(Request $request){
        $data = $request->json()->all();
        // dd($data);

        return response()->json([])->header('Location', route('exam.create'));
    }
}
