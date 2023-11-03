<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('faculty.index');
    }
    
    // public function examsched(){
    //     return view('teacher.managerequest');
    // }

    public function ManageRequest(){
        return view('faculty.managerequest');
    }
    




}
