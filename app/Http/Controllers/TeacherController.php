<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('faculty.index');
    }
    
    public function show(){
        return view('faculty.show');
    }

    public function manageRequest(){
        return view('faculty.managerequest');
    }
    
    public function requestArchive(){
        return view('faculty.requestarchive');
    }

    // public function changeprofilePic(){
    //     return view('faculty.changeprofilepic');
    // }

    public function changePass(){
        return view('faculty.changepass');
    }

    public function aboutUs(){
        return view('faculty.aboutus');
    }

}
