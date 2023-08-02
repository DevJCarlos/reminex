<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Http\Request;

class ExamController extends Controller

{
    //
    public function create(){
        return view('exams.create');
    }

    public function index()
    {
        
        $rooms = Rooms::all();
        dd($rooms);
        

        return view('exams.create', compact('rooms'));
    }
    
}
