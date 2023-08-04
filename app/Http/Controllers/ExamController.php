<?php

namespace App\Http\Controllers;
use App\Models\Rooms;
use Illuminate\Http\Request;

class ExamController extends Controller

{
    //
    public function create(){
        $rooms = $this->getRooms();
        return view('exams.create', compact('rooms'));
    }

    public function index()
    {
        
        
    }
    public function getRooms(){
        $rooms = Rooms::all();
        return $rooms;
    }
    
}
