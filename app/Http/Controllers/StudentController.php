<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NewSched;

class StudentController extends Controller
{
    public function index(){
        $user = User::find(1);
        return view('student.index', compact('user'));
    }

    public function show(){
        return view('student.show');
    }

    public function createRequest(){
        return view('student.createrequest');
    }

    public function viewRequest(){
        return view('student.viewrequest');
    }

    public function newSched(){
        return view('student.newsched');
    }

    // public function changeprofilePic(){
    //     return view('student.changeprofilepic');
    // }

    public function changePass(){
        return view('student.changepass');
    }

    public function aboutUs(){
        return view('student.aboutus');
    }
}
